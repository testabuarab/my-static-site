<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\AssetCarouselOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\AssetRendered;
use craft\base\Model;
use craft\fields\Assets;

/**
 * Renders an asset field as carousel
 */
class AssetCarousel extends AssetRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'asset-carousel';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Carousel');
    }

    /**
     * @inheritDoc
     */
    public function getOptionsModel(): string
    {
        return AssetCarouselOptions::class;
    }

    /**
     * @inheritDoc
     */
    public static function getFieldTargets(): array
    {
        return [Assets::class];
    }
}