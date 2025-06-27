<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\utilities;

use Craft;
use craft\base\Utility;
use putyourlightson\blitz\assets\BlitzAsset;
use putyourlightson\blitz\Blitz;
use putyourlightson\blitz\console\controllers\CacheController;

class CacheUtility extends Utility
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('blitz', 'Blitz Cache');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'blitz-cache';
    }

    /**
     * @inheritdoc
     */
    public static function iconPath(): ?string
    {
        $iconPath = Craft::getAlias('@putyourlightson/blitz/icon-mask.svg');

        if (!is_string($iconPath)) {
            return null;
        }

        return $iconPath;
    }

    /**
     * @inheritdoc
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(BlitzAsset::class);

        return Craft::$app->getView()->renderTemplate('blitz/_utilities/cache', [
            'driverHtml' => Blitz::$plugin->cacheStorage->getUtilityHtml(),
            'actions' => self::getActions(),
            'tagSuggestions' => self::getTagSuggestions(),
        ]);
    }

    /**
     * Returns available actions.
     * Instruction text should match that of the cache console controller.
     *
     * @see CacheController
     */
    public static function getActions(bool $showAll = false): array
    {
        $actions = [];

        $actions[] = [
            'id' => 'clear',
            'label' => Craft::t('blitz', 'Clear Cache'),
            'instructions' => Craft::t('blitz', 'Deletes all cached pages.'),
        ];

        $actions[] = [
            'id' => 'flush',
            'label' => Craft::t('blitz', 'Flush Cache'),
            'instructions' => Craft::t('blitz', 'Deletes all cache records from the database.'),
        ];

        $actions[] = [
            'id' => 'generate',
            'label' => Craft::t('blitz', 'Generate Cache'),
            'instructions' => Craft::t('blitz', 'Generates all cacheable pages.'),
        ];

        if ($showAll || Blitz::$plugin->cachePurger->isDummy === false) {
            $actions[] = [
                'id' => 'purge',
                'label' => Craft::t('blitz', 'Purge Cache'),
                'instructions' => Craft::t('blitz', 'Deletes all cached pages from the reverse proxy.'),
            ];
        }

        if ($showAll || Blitz::$plugin->deployer->isDummy === false) {
            $actions[] = [
                'id' => 'deploy',
                'label' => Craft::t('blitz', 'Deploy to Remote'),
                'instructions' => Craft::t('blitz', 'Deploys all cached files to the remote location.'),
            ];
        }

        $actions[] = [
            'id' => 'refresh',
            'label' => Craft::t('blitz', 'Refresh Cache'),
            'instructions' => Craft::t('blitz', 'Refreshes all pages according to the “Refresh Mode”.'),
        ];

        $actions[] = [
            'id' => 'refresh-expired',
            'label' => Craft::t('blitz', 'Refresh Expired Cache'),
            'instructions' => Craft::t('blitz', 'Refreshes pages that have expired since they were cached.'),
        ];

        if (Craft::$app->getIsMultiSite()) {
            $options = [];
            $sites = Craft::$app->getSites()->getAllSites();

            foreach ($sites as $site) {
                $options[$site->id] = $site->name;
            }

            $actions[] = [
                'id' => 'refresh-site',
                'label' => Craft::t('blitz', 'Refresh Site Cache'),
                'instructions' => Craft::t('blitz', 'Refreshes all pages in the provided site.'),
                'options' => $options,
            ];
        }

        $actions[] = [
            'id' => 'refresh-urls',
            'label' => Craft::t('blitz', 'Refresh Cached URLs'),
            'instructions' => Craft::t('blitz', 'Refreshes cached pages with the provided URLs (the `*` wildcard is supported).'),
        ];

        $actions[] = [
            'id' => 'refresh-tagged',
            'label' => Craft::t('blitz', 'Refresh Tagged Cache'),
            'instructions' => Craft::t('blitz', 'Refreshes cached pages with the provided tags.'),
        ];

        return $actions;
    }

    /**
     * Returns tag suggestions.
     */
    public static function getTagSuggestions(): array
    {
        $tags = Blitz::$plugin->cacheTags->getAllTags();

        $data = [];

        foreach ($tags as $tag) {
            $data[] = [
                'name' => $tag,
            ];
        }

        return [
            [
                'label' => Craft::t('blitz', 'Tags'),
                'data' => $data,
            ],
        ];
    }
}
