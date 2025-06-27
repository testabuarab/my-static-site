<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\CraftThemes\models\fieldDisplayers\TagRendered;

/**
 * Renders a tag field as a list group
 */
class TagListGroup extends TagRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'tag-listgroup';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'List group');
    }
}