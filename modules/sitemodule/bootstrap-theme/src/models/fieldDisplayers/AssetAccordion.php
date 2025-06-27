<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\AssetAccordionOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\AssetRendered;
use craft\fields\Assets;

/**
 * Renders assets as accordion
 */
class AssetAccordion extends AssetRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'asset-accordion';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Accordion');
    }

    /**
     * @inheritDoc
     */
    public function getOptionsModel(): string
    {
        return AssetAccordionOptions::class;
    }

    /**
     * @inheritDoc
     */
    public static function getFieldTargets(): array
    {
        return [Assets::class];
    }
}