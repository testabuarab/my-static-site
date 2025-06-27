<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\CategoryAccordionOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\CategoryRendered;

/**
 * Renders a category field as accordion
 */
class CategoryAccordion extends CategoryRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'category-accordion';

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
        return CategoryAccordionOptions::class;
    }
}