<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\CategoryCardOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\CategoryRendered;

/**
 * Renders a category field as a card
 */
class CategoryCard extends CategoryRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'category-card';

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
        return CategoryCardOptions::class;
    }
}