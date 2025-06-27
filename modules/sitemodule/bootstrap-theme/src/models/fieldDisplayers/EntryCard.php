<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\EntryCardOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\EntryRendered;

/**
 * Renders entries as a card
 */
class EntryCard extends EntryRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'entry-card';

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
        return EntryCardOptions::class;
    }
}