<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\AssetCardOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\AssetRendered;
use craft\fields\Assets;

/**
 * Renders assets as accordion
 */
class AssetCard extends AssetRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'asset-card';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Card');
    }

    /**
     * @inheritDoc
     */
    public function getOptionsModel(): string
    {
        return AssetCardOptions::class;
    }

    /**
     * @inheritDoc
     */
    public static function getFieldTargets(): array
    {
        return [Assets::class];
    }
}