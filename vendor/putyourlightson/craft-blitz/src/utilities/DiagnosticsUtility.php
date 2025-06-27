<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\utilities;

use Craft;
use craft\base\Utility;
use putyourlightson\blitz\assets\BlitzAsset;
use putyourlightson\blitz\helpers\DiagnosticsHelper;

/**
 * @since 4.10.0
 */
class DiagnosticsUtility extends Utility
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('blitz', 'Blitz Diagnostics');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'blitz-diagnostics';
    }

    /**
     * @inheritdoc
     */
    public static function iconPath(): ?string
    {
        $iconPath = Craft::getAlias('@putyourlightson/blitz/resources/icons/diagnostics.svg');

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

        return Craft::$app->getView()->renderTemplate('blitz/_utilities/diagnostics/', [
            'siteId' => DiagnosticsHelper::getSiteId(),
        ]);
    }
}
