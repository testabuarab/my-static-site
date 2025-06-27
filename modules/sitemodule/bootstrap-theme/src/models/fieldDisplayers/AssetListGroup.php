<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\CraftThemes\models\fieldDisplayers\AssetRendered;
use craft\fields\Assets;

/**
 * Renders assets as list group
 */
class AssetListGroup extends AssetRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'asset-listgroup';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'List group');
    }

    /**
     * @inheritDoc
     */
    public static function getFieldTargets(): array
    {
        return [Assets::class];
    }
}