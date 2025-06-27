<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\CraftThemes\models\fieldDisplayers\EntryRendered;

/**
 * Renders entries as a list group
 */
class EntryListGroup extends EntryRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'entry-listgroup';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'List group');
    }
}