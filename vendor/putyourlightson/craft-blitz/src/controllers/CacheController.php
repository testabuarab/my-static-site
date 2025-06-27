<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\controllers;

use Craft;
use craft\helpers\App;
use craft\helpers\StringHelper;
use craft\web\Controller;
use craft\web\View;
use putyourlightson\blitz\Blitz;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class CacheController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;

    /**
     * @var bool Disable Snaptcha validation
     */
    public bool $enableSnaptchaValidation = false;

    /**
     * @inheritdoc
     */
    protected array|bool|int $allowAnonymous = true;

    /**
     * @inheritdoc
     */
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $request = Craft::$app->getRequest();

        // Require permission if posted from utility
        if ($request->getIsPost() && $request->getParam('utility')) {
            $this->requirePermission('blitz:' . $action->id);
        } else {
            // Verify API key
            $key = $request->getParam('key');
            $apiKey = App::parseEnv(Blitz::$plugin->settings->apiKey);

            if (empty($key) || empty($apiKey) || $key != $apiKey) {
                throw new ForbiddenHttpException('Unauthorised access.');
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result): mixed
    {
        // If front-end request, run the queue to ensure action is completed in full
        if (Craft::$app->getView()->templateMode == View::TEMPLATE_MODE_SITE) {
            Craft::$app->runAction('queue/run');
        }

        return parent::afterAction($action, $result);
    }

    /**
     * Clears the cache.
     */
    public function actionClear(): Response
    {
        Blitz::$plugin->clearCache->clearAll();

        return $this->_getSuccessResponse('Blitz cache successfully cleared.');
    }

    /**
     * Flushes the cache.
     */
    public function actionFlush(): Response
    {
        Blitz::$plugin->flushCache->flushAll();

        return $this->_getSuccessResponse('Blitz cache successfully flushed.');
    }

    /**
     * Purges the cache.
     */
    public function actionPurge(): Response
    {
        Blitz::$plugin->cachePurger->purgeAll();

        return $this->_getSuccessResponse('Blitz cache successfully purged.');
    }

    /**
     * Generates the cache.
     */
    public function actionGenerate(): Response
    {
        if (!Blitz::$plugin->settings->cachingEnabled) {
            return $this->_getFailureResponse('Blitz caching is disabled.');
        }

        Blitz::$plugin->cacheGenerator->generateAll();

        return $this->_getSuccessResponse('Blitz cache successfully queued for generation.');
    }

    /**
     * Deploys the cache.
     */
    public function actionDeploy(): Response
    {
        if (!Blitz::$plugin->settings->cachingEnabled) {
            return $this->_getFailureResponse('Blitz caching is disabled.');
        }

        Blitz::$plugin->deployer->deployAll();

        return $this->_getSuccessResponse('Blitz cache successfully queued for deployment.');
    }

    /**
     * Refreshes the entire cache, respecting the “Refresh Mode”.
     */
    public function actionRefresh(): Response
    {
        Blitz::$plugin->refreshCache->refreshAll();
        $message = 'Blitz cache successfully refreshed.';

        if (Blitz::$plugin->settings->generateOnRefresh()) {
            $message = 'Blitz cache successfully refreshed and queued for generation.';
        }

        return $this->_getSuccessResponse($message);
    }

    /**
     * Refreshes expired cache.
     */
    public function actionRefreshExpired(): Response
    {
        Blitz::$plugin->refreshCache->refreshExpiredCache();

        return $this->_getSuccessResponse('Expired cache successfully refreshed.');
    }

    /**
     * Refreshes site cache.
     */
    public function actionRefreshSite(): Response
    {
        $siteId = Craft::$app->getRequest()->getParam('siteId');

        if (empty($siteId)) {
            return $this->_getFailureResponse('A site ID must be provided.');
        }

        Blitz::$plugin->refreshCache->refreshSite($siteId);
        $message = 'Site successfully refreshed.';

        if (Blitz::$plugin->settings->generateOnRefresh()) {
            $message = 'Site successfully refreshed and queued for generation.';
        }

        return $this->_getSuccessResponse($message);
    }

    /**
     * Refreshes cached URLs.
     */
    public function actionRefreshUrls(): Response
    {
        $urls = Craft::$app->getRequest()->getParam('urls');
        $urls = $this->_normalizeArguments($urls);

        if (empty($urls)) {
            return $this->_getFailureResponse('At least one URL must be provided.');
        }

        Blitz::$plugin->refreshCache->refreshCachedUrls($urls);

        return $this->_getSuccessResponse('Cached URLs successfully refreshed.');
    }

    /**
     * Refreshes tagged cache.
     */
    public function actionRefreshTagged(): Response
    {
        $tags = Craft::$app->getRequest()->getParam('tags');
        $tags = $this->_normalizeArguments($tags);

        if (empty($tags)) {
            return $this->_getFailureResponse('At least one tag must be provided.');
        }

        Blitz::$plugin->refreshCache->refreshCacheTags($tags);

        return $this->_getSuccessResponse('Tagged cache successfully refreshed.');
    }

    /**
     * Returns a success response.
     */
    private function _getSuccessResponse(string $message): Response
    {
        Blitz::$plugin->log($message . ' [via cache utility by "{username}"]');

        Craft::$app->getSession()->setNotice(Craft::t('blitz', $message));

        return $this->_getResponse($message);
    }

    /**
     * Returns a failure response.
     */
    private function _getFailureResponse(string $message): Response
    {
        Craft::$app->getSession()->setError(Craft::t('blitz', $message));

        return $this->_getResponse($message, false);
    }

    /**
     * Returns a response with the provided message.
     */
    private function _getResponse(string $message, bool $success = true): Response
    {
        $request = Craft::$app->getRequest();

        // If front-end or JSON request
        if (Craft::$app->getView()->templateMode == View::TEMPLATE_MODE_SITE || $request->getAcceptsJson()) {
            return $this->asJson([
                'success' => $success,
                'message' => Craft::t('blitz', $message),
            ]);
        }

        return $this->redirectToPostedUrl();
    }

    /**
     * Normalizes values as an array of arguments.
     *
     * @return string[]
     */
    private function _normalizeArguments(array|string|null $values): array
    {
        if (is_string($values)) {
            $values = StringHelper::split($values);
        }

        if (is_array($values)) {
            // Flatten multi-dimensional arrays
            $values = array_map(fn($value) => is_array($value) ? reset($value) : $value, $values);

            // Remove empty values
            return array_filter($values);
        }

        return [];
    }
}
