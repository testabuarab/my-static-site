<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\EntryAccordionOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\EntryRendered;

/**
 * Renders entries as accordion
 */
class EntryAccordion extends EntryRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'entry-accordion';

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
        return EntryAccordionOptions::class;
    }
}