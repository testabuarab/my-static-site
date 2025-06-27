<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\services;

use Craft;
use craft\base\Component;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\behaviors\CustomFieldBehavior;
use craft\db\ActiveRecord;
use craft\elements\db\ElementQuery;
use craft\events\CancelableEvent;
use craft\events\EagerLoadElementsEvent;
use craft\events\PopulateElementEvent;
use craft\events\PopulateElementsEvent;
use craft\events\TemplateEvent;
use craft\helpers\Db;
use craft\helpers\StringHelper;
use craft\models\Section;
use craft\records\Element as ElementRecord;
use craft\services\Elements;
use craft\web\View;
use putyourlightson\blitz\behaviors\BlitzCustomFieldBehavior;
use putyourlightson\blitz\Blitz;
use putyourlightson\blitz\events\SaveCacheEvent;
use putyourlightson\blitz\helpers\ElementQueryHelper;
use putyourlightson\blitz\helpers\ElementTypeHelper;
use putyourlightson\blitz\helpers\SiteUriHelper;
use putyourlightson\blitz\models\CacheOptionsModel;
use putyourlightson\blitz\models\GenerateDataModel;
use putyourlightson\blitz\models\SettingsModel;
use putyourlightson\blitz\models\SiteUriModel;
use putyourlightson\blitz\records\CacheRecord;
use putyourlightson\blitz\records\ElementCacheRecord;
use putyourlightson\blitz\records\ElementFieldCacheRecord;
use putyourlightson\blitz\records\ElementQueryAttributeRecord;
use putyourlightson\blitz\records\ElementQueryCacheRecord;
use putyourlightson\blitz\records\ElementQueryFieldRecord;
use putyourlightson\blitz\records\ElementQueryRecord;
use putyourlightson\blitz\records\ElementQuerySourceRecord;
use putyourlightson\blitz\records\IncludeRecord;
use putyourlightson\blitz\records\SsiIncludeCacheRecord;
use yii\base\Event;
use yii\db\Exception;
use yii\log\Logger;

class GenerateCacheService extends Component
{
    /**
     * @event RefreshCacheEvent
     */
    public const EVENT_BEFORE_SAVE_CACHE = 'beforeSaveCache';

    /**
     * @event RefreshCacheEvent
     */
    public const EVENT_AFTER_SAVE_CACHE = 'afterSaveCache';

    /**
     * @const string
     */
    public const MUTEX_LOCK_NAME_CACHE_RECORDS = 'blitz:cacheRecords';

    /**
     * @const string
     */
    public const MUTEX_LOCK_NAME_ELEMENT_QUERY_RECORDS = 'blitz:elementQueryRecords';

    /**
     * @const string
     */
    public const MUTEX_LOCK_NAME_INCLUDE_RECORDS = 'blitz:includeRecords';

    /**
     * @const string
     */
    public const MUTEX_LOCK_NAME_SSI_INCLUDE_RECORDS = 'blitz:ssiIncludeRecords';

    /**
     * @var GenerateDataModel
     */
    public GenerateDataModel $generateData;

    /**
     * @var CacheOptionsModel
     */
    public CacheOptionsModel $options;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        $this->reset();
    }

    /**
     * Resets the component, so it can be used multiple times in the same request.
     */
    public function reset(): void
    {
        $this->generateData = new GenerateDataModel();
        $this->options = new CacheOptionsModel();

        // Set default attributes from the plugin settings
        $this->options->setAttributes(Blitz::$plugin->settings->getAttributes(), false);
    }

    /**
     * Registers element prepare events.
     */
    public function registerElementPrepareEvents(): void
    {
        /**
         * Both the `EVENT_AFTER_POPULATE_ELEMENT` and `EVENT_AFTER_POPULATE_ELEMENTS`
         * events must be used to ensure that eager-loaded elements and eager-loaded
         * fields are tracked respectively.
         * https://github.com/putyourlightson/craft-blitz/issues/514
         */
        Event::on(ElementQuery::class, ElementQuery::EVENT_AFTER_POPULATE_ELEMENT,
            function(PopulateElementEvent $event) {
                if (Craft::$app->getResponse()->getIsOk()) {
                    $this->addElement($event->element);
                }
            }
        );
        Event::on(ElementQuery::class, ElementQuery::EVENT_AFTER_POPULATE_ELEMENTS,
            function(PopulateElementsEvent $event) {
                if (Craft::$app->getResponse()->getIsOk()) {
                    foreach ($event->elements as $element) {
                        $this->addElement($element);
                    }
                }
            }
        );

        /**
         * Track eager-loaded elements, including disabled elements, from the mapping target.
         * https://github.com/putyourlightson/craft-blitz/issues/555
         *
         * @see Elements::_eagerLoadElementsInternal()
         */
        Event::on(Elements::class, Elements::EVENT_BEFORE_EAGER_LOAD_ELEMENTS,
            function(EagerLoadElementsEvent $event) {
                foreach ($event->with as $plan) {
                    // Get the eager-loading map from the source element type
                    /** @var ElementInterface|string $elementType */
                    $elementType = $event->elementType;
                    $map = $elementType::eagerLoadingMap($event->elements, $plan->handle);

                    if (is_array($map)) {
                        if ($this->_shouldTrackElementsOfType($map['elementType'])) {
                            foreach ($map['map'] as $mapping) {
                                $this->generateData->addElementId($mapping['target']);
                            }
                        }
                    }
                }
            }
        );

        /**
         * Catch elements injected into rendered templates as variables or preloaded singles,
         * so we can also track fields eager-loaded via `eagerLoadElements()` directly.
         *
         * @see Elements::eagerLoadElements()
         */
        Event::on(View::class, View::EVENT_AFTER_RENDER_TEMPLATE,
            function(TemplateEvent $event) {
                if (Craft::$app->getResponse()->getIsOk()) {
                    $variables = $event->variables;

                    if (Craft::$app->getConfig()->getGeneral()->preloadSingles ?? false) {
                        $singles = Craft::$app->getSections()->getSectionsByType(Section::TYPE_SINGLE);
                        $handles = array_map(fn(Section $section) => $section->handle, $singles);
                        $variables += Craft::$app->getEntries()->getSingleEntriesByHandle($handles);
                    }

                    foreach ($variables as $variable) {
                        if ($variable instanceof Element) {
                            $this->addElement($variable);
                        }
                    }
                }
            }
        );

        Event::on(ElementQuery::class, ElementQuery::EVENT_BEFORE_PREPARE,
            function(CancelableEvent $event) {
                if (Craft::$app->getResponse()->getIsOk()) {
                    /** @var ElementQuery $elementQuery */
                    $elementQuery = $event->sender;
                    $this->addElementQuery($elementQuery);
                }
            }
        );
    }

    /**
     * Adds an element to be cached.
     */
    public function addElement(ElementInterface $element): void
    {
        if (!$this->_shouldTrackElementsOfType($element::class)) {
            return;
        }

        $this->generateData->addElement($element);

        // Add eager-loaded fields since they will be accessed directly on the element
        $fieldHandles = array_keys(CustomFieldBehavior::$fieldHandles);
        foreach ($fieldHandles as $handle) {
            if ($element->hasEagerLoadedElements($handle)) {
                $this->generateData->addElementTrackField($element, $handle);
            }
        }

        // Replace the custom field behavior with our own (only once)
        $customFields = $element->getBehavior('customFields');
        if ($customFields instanceof CustomFieldBehavior) {
            $element->attachBehavior('customFields',
                BlitzCustomFieldBehavior::create($customFields)
            );
        }
    }

    /**
     * Adds an element query to be cached.
     */
    public function addElementQuery(ElementQuery $elementQuery): void
    {
        if (!$this->_shouldTrackElementQueriesOfType($elementQuery->elementType)) {
            return;
        }

        // Don’t proceed if the query has fixed IDs or slugs
        if (ElementQueryHelper::hasFixedIdsOrSlugs($elementQuery)) {
            return;
        }

        // Don’t proceed if the query contains an expression criteria
        if (ElementQueryHelper::containsExpressionCriteria($elementQuery)) {
            return;
        }

        // Don’t proceed if the order is random
        if (ElementQueryHelper::isOrderByRandom($elementQuery)) {
            return;
        }

        // Don’t proceed if this is a draft or revision query
        if (ElementQueryHelper::isDraftOrRevisionQuery($elementQuery)) {
            return;
        }

        // Don’t proceed if this is an entry query for “single” sections
        if (ElementQueryHelper::isEntryQueryForSingleSections($elementQuery)) {
            return;
        }

        // Don’t proceed if this is a relation field query
        if (ElementQueryHelper::isRelationFieldQuery($elementQuery)) {
            $this->_addRelatedElementIds($elementQuery);

            return;
        }

        $this->saveElementQuery($elementQuery);
    }

    /**
     * Adds an SSI include.
     */
    public function addSsiInclude(int $includeId): void
    {
        // Don’t proceed if element query caching is disabled
        if (Blitz::$plugin->settings->cachingEnabled === false) {
            return;
        }

        $this->generateData->addSsiIncludes($includeId);
    }

    /**
     * Saves an element query.
     */
    public function saveElementQuery(ElementQuery $elementQuery): void
    {
        $params = json_encode(ElementQueryHelper::getUniqueElementQueryParams($elementQuery));
        $index = $this->_createUniqueIndex($elementQuery->elementType . $params);

        // Require a mutex for the element query index to avoid doing the same operation multiple times
        $mutex = Craft::$app->getMutex();
        $lockName = self::MUTEX_LOCK_NAME_ELEMENT_QUERY_RECORDS . ':' . $index;

        if (!$mutex->acquire($lockName, Blitz::$plugin->settings->mutexTimeout)) {
            return;
        }

        $db = Craft::$app->getDb();

        // Use the primary connection when fetching the record
        $queryId = $db->usePrimary(fn() => ElementQueryRecord::find()
            ->select('id')
            ->where(['index' => $index])
            ->scalar()
        );

        if (!$queryId) {
            try {
                // Use DB connection, so we can exclude audit columns when inserting
                $db->createCommand()
                    ->insert(
                        ElementQueryRecord::tableName(),
                        [
                            'index' => $index,
                            'type' => $elementQuery->elementType,
                            'params' => $params,
                        ],
                    )
                    ->execute();

                $queryId = (int)$db->getLastInsertID();

                $this->saveElementQuerySources($elementQuery, $queryId);
                $this->saveElementQueryAttributes($elementQuery, $queryId);
                $this->saveElementQueryFields($elementQuery, $queryId);
            } catch (Exception $exception) {
                Blitz::$plugin->log($exception->getMessage(), [], Logger::LEVEL_ERROR);
            }
        }

        if ($queryId) {
            $this->generateData->addElementQueryId($queryId);
        }

        $mutex->release($lockName);
    }

    /**
     * Saves an element query's sources.
     */
    public function saveElementQuerySources(ElementQuery $elementQuery, int $queryId): void
    {
        $sourceIdAttribute = ElementTypeHelper::getSourceIdAttribute($elementQuery->elementType);
        $sourceIds = $sourceIdAttribute ? $elementQuery->{$sourceIdAttribute} : null;

        if (empty($sourceIds)) {
            return;
        }

        // Normalize source IDs
        $sourceIds = ElementQueryHelper::getNormalizedElementQueryIdParam($sourceIds);

        // Convert to an array
        if (!is_array($sourceIds)) {
            $sourceIds = [$sourceIds];
        }

        foreach ($sourceIds as $sourceId) {
            // Stop if a string is encountered
            if (is_string($sourceId)) {
                return;
            }
        }

        $this->_batchInsertQueries(
            $queryId,
            $sourceIds,
            ElementQuerySourceRecord::tableName(),
            'sourceId',
        );
    }

    /**
     * Saves an element query’s attributes.
     */
    public function saveElementQueryAttributes(ElementQuery $elementQuery, int $queryId): void
    {
        $attributes = ElementQueryHelper::getElementQueryAttributes($elementQuery);

        $this->_batchInsertQueries(
            $queryId,
            $attributes,
            ElementQueryAttributeRecord::tableName(),
            'attribute',
        );
    }

    /**
     * Saves an element query's fields.
     */
    public function saveElementQueryFields(ElementQuery $elementQuery, int $queryId): void
    {
        $fieldIds = ElementQueryHelper::getElementQueryFieldIds($elementQuery);

        $this->_batchInsertQueries(
            $queryId,
            $fieldIds,
            ElementQueryFieldRecord::tableName(),
            'fieldId',
        );
    }

    /**
     * Saves an include.
     */
    public function saveInclude(int $siteId, string $template, array $params): ?array
    {
        $params = json_encode($params);
        $index = $this->_createUniqueIndex($siteId . $template . $params);

        // Require a mutex to avoid doing the same operation multiple times
        $mutex = Craft::$app->getMutex();
        $lockName = self::MUTEX_LOCK_NAME_INCLUDE_RECORDS . ':' . $index;

        if (!$mutex->acquire($lockName, Blitz::$plugin->settings->mutexTimeout)) {
            return null;
        }

        $db = Craft::$app->getDb();

        // Use the primary connection when fetching the record
        $includeId = $db->usePrimary(fn() => IncludeRecord::find()
            ->select('id')
            ->where(['index' => $index])
            ->scalar()
        );

        if (!$includeId) {
            try {
                // Use DB connection, so we can exclude audit columns when inserting
                $db->createCommand()
                    ->insert(
                        IncludeRecord::tableName(),
                        [
                            'index' => $index,
                            'siteId' => $siteId,
                            'template' => $template,
                            'params' => $params,
                        ],
                    )
                    ->execute();

                $includeId = $db->getLastInsertID();
            } catch (Exception $exception) {
                Blitz::$plugin->log($exception->getMessage(), [], Logger::LEVEL_ERROR);
            }
        }

        $mutex->release($lockName);

        return $includeId ? [$includeId, $index] : null;
    }

    /**
     * Saves the content for a site URI to the cache.
     */
    public function save(string $content, SiteUriModel $siteUri): ?string
    {
        if ($this->options->cachingEnabled === false) {
            return null;
        }

        // Don’t cache if the output contains any transform generation URLs
        // https://github.com/putyourlightson/craft-blitz/issues/125
        if (StringHelper::contains(stripslashes($content), 'assets/generate-transform')) {
            Blitz::$plugin->debug('Page not cached because it contains transform generation URLs. Consider setting the `generateTransformsBeforePageLoad` general config setting to `true` to fix this.', [], $siteUri->getUrl());

            return null;
        }

        $mutex = Craft::$app->getMutex();
        $lockName = self::MUTEX_LOCK_NAME_CACHE_RECORDS;

        if (!$mutex->acquire($lockName, Blitz::$plugin->settings->mutexTimeout)) {
            Blitz::$plugin->debug('Page not cached because a `{lockName}` mutex could not be acquired.', [
                'lockName' => $lockName,
            ], $siteUri->getUrl());

            return null;
        }

        $db = Craft::$app->getDb();

        $cacheValue = $siteUri->toArray();

        // Delete cache records so we get a fresh cache.
        CacheRecord::deleteAll($cacheValue);

        // Don’t paginate URIs that are already paginated.
        $paginate = SiteUriHelper::isPaginatedUri($siteUri->uri) ? null : $this->options->paginate;

        $cacheValue = array_merge($cacheValue, [
            'paginate' => $paginate,
            'expiryDate' => Db::prepareDateForDb($this->options->expiryDate),
        ]);

        $db->createCommand()
            ->insert(
                CacheRecord::tableName(),
                $cacheValue
            )
            ->execute();

        $cacheId = (int)$db->getLastInsertID();

        $this->_batchInsertElementCaches($cacheId);

        $this->_batchInsertCaches(
            $cacheId,
            $this->generateData->getElementQueryIds(),
            ElementQueryRecord::tableName(),
            ElementQueryCacheRecord::tableName(),
            'queryId',
        );

        $this->_batchInsertCaches(
            $cacheId,
            $this->generateData->getSsiIncludeIds(),
            IncludeRecord::tableName(),
            SsiIncludeCacheRecord::tableName(),
            'includeId',
        );

        // Save cache tags
        if (!empty($this->options->tags)) {
            Blitz::$plugin->cacheTags->saveTags($this->options->tags, $cacheId);
        }

        $isCachedInclude = Blitz::$plugin->cacheRequest->getIsCachedInclude();
        if (!$isCachedInclude) {
            $outputComments = $this->options->outputComments;

            if ($outputComments === null) {
                $outputComments = Blitz::$plugin->settings->outputComments;
            }

            $outputComments = $outputComments === true || $outputComments === SettingsModel::OUTPUT_COMMENTS_CACHED;

            // Append cached by comment if allowed and has HTML mime type
            if ($outputComments && SiteUriHelper::hasHtmlMimeType($siteUri)) {
                $content .= '<!-- Cached by Blitz on ' . date('c') . ' -->';
            }
        }

        $duration = $this->options->getCacheDuration();

        // Disallow encoding for cache includes and pages with includes
        $allowEncoding = !$isCachedInclude && !$this->generateData->getHasIncludes();

        $this->saveOutput($content, $siteUri, $duration, $allowEncoding);

        $this->reset();

        $mutex->release($lockName);

        return $content;
    }

    /**
     * Saves the output for a site URI.
     */
    public function saveOutput(string $output, SiteUriModel $siteUri, int $duration = null, bool $allowEncoding = true): void
    {
        $event = new SaveCacheEvent([
            'output' => $output,
            'siteUri' => $siteUri,
            'duration' => $duration,
            'allowEncoding' => $allowEncoding,
        ]);
        $this->trigger(self::EVENT_BEFORE_SAVE_CACHE, $event);

        if (!$event->isValid) {
            Blitz::$plugin->debug('Page not cached because the `{event}` event is not valid.', [
                'event' => self::EVENT_BEFORE_SAVE_CACHE,
            ], $siteUri->getUrl());

            return;
        }

        Blitz::$plugin->cacheStorage->save($event->output, $event->siteUri, $event->duration, $event->allowEncoding);

        if ($this->hasEventHandlers(self::EVENT_AFTER_SAVE_CACHE)) {
            $this->trigger(self::EVENT_AFTER_SAVE_CACHE, $event);
        }
    }

    private function _shouldTrackElementsOfType(string $elementType): bool
    {
        // Don’t proceed if element tracking is disabled
        if (!Blitz::$plugin->settings->trackElements || !$this->options->trackElements) {
            return false;
        }

        // Don’t proceed if element caching is disabled
        /** @noinspection PhpDeprecationInspection */
        if (!Blitz::$plugin->settings->cacheElements || !$this->options->cacheElements) {
            return false;
        }

        // Don’t proceed if not a cacheable element type
        if (!ElementTypeHelper::getIsCacheableElementType($elementType)) {
            return false;
        }

        return true;
    }

    private function _shouldTrackElementQueriesOfType(string $elementType): bool
    {
        // Don’t proceed if element query tracking is disabled
        if (!Blitz::$plugin->settings->trackElementQueries || !$this->options->trackElementQueries) {
            return false;
        }

        // Don’t proceed if element query caching is disabled
        /** @noinspection PhpDeprecationInspection */
        if (!Blitz::$plugin->settings->cacheElementQueries || !$this->options->cacheElementQueries) {
            return false;
        }

        // Don’t proceed if not a cacheable element type
        if (!ElementTypeHelper::getIsCacheableElementType($elementType)) {
            return false;
        }

        return true;
    }

    /**
     * Adds related element IDs with all statuses so that disabled elements will
     * trigger a refresh whenever enabled.
     * https://github.com/putyourlightson/craft-blitz/issues/555
     */
    private function _addRelatedElementIds(ElementQuery $elementQuery): void
    {
        if (!$this->_shouldTrackElementsOfType($elementQuery->elementType)) {
            return;
        }

        // Temporarily disable element query tracking to prevent an endless loop.
        $originalTrackElementQueries = $this->options->trackElementQueries;
        $this->options->trackElementQueries = false;

        // Clone the original element query rather than manipulating it directly.
        $elementQueryClone = clone $elementQuery;
        $elementQueryClone->status(null);
        $elementIds = $elementQueryClone->ids();
        $this->generateData->addElementIds($elementIds);

        $this->options->trackElementQueries = $originalTrackElementQueries;
    }

    /**
     * Batch inserts element caches into the database.
     */
    private function _batchInsertElementCaches(int $cacheId): void
    {
        $elementIds = $this->generateData->getElementIds();
        $elementIndexedTrackFields = $this->generateData->getElementIndexedTrackFields();

        $this->_batchInsertCaches(
            $cacheId,
            $elementIds,
            ElementRecord::tableName(),
            ElementCacheRecord::tableName(),
            'elementId',
        );

        if (!empty($elementIndexedTrackFields)) {
            $this->_batchInsertCaches(
                $cacheId,
                $elementIds,
                ElementRecord::tableName(),
                ElementFieldCacheRecord::tableName(),
                'elementId',
                $elementIndexedTrackFields,
                'fieldId',
            );
        }
    }

    /**
     * Batch inserts cache values into the database.
     */
    private function _batchInsertCaches(int $cacheId, array $ids, string $checkTable, string $insertTable, string $columnName, array $extraColumnValues = null, string $extraColumnName = null): void
    {
        if (empty($ids)) {
            return;
        }

        // Get valid IDs by selecting only records with existing IDs
        $validIds = ActiveRecord::find()
            ->select('id')
            ->from($checkTable)
            ->where(['id' => $ids])
            ->column();

        $values = [];
        foreach ($validIds as $id) {
            if ($extraColumnValues === null) {
                $values[] = [$cacheId, $id];
            } elseif (isset($extraColumnValues[$id])) {
                foreach ($extraColumnValues[$id] as $extraValue) {
                    $values[] = [$cacheId, $id, $extraValue];
                }
            }
        }

        $columns = ['cacheId', $columnName];
        if ($extraColumnName !== null) {
            $columns[] = $extraColumnName;
        }

        try {
            Craft::$app->getDb()->createCommand()
                ->batchInsert(
                    $insertTable,
                    $columns,
                    $values,
                )
                ->execute();
        } catch (Exception $exception) {
            Blitz::$plugin->log($exception->getMessage(), [], Logger::LEVEL_ERROR);
        }
    }

    /**
     * Batch inserts query values into the database.
     */
    private function _batchInsertQueries(int $queryId, array $ids, string $insertTable, string $columnName): void
    {
        $values = [];
        foreach ($ids as $id) {
            $values[] = [$queryId, $id];
        }

        $columns = ['queryId', $columnName];

        try {
            Craft::$app->getDb()->createCommand()
                ->batchInsert(
                    $insertTable,
                    $columns,
                    $values,
                )
                ->execute();
        } catch (Exception $exception) {
            Blitz::$plugin->log($exception->getMessage(), [], Logger::LEVEL_ERROR);
        }
    }

    /**
     * Creates a unique index for quicker indexing and less storage.
     */
    private function _createUniqueIndex(string $value): string
    {
        return sprintf('%u', crc32($value));
    }
}
