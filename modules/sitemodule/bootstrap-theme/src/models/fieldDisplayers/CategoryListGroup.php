<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\CraftThemes\models\fieldDisplayers\CategoryRendered;

/**
 * Renders a category field as list group
 */
class CategoryListGroup extends CategoryRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'category-listgroup';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'List group');
    }
}