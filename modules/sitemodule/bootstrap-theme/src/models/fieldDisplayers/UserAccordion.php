<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\UserAccordionOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\UserRendered;

/**
 * Renders a user field as accordion
 */
class UserAccordion extends UserRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'user-accordion';

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
        return UserAccordionOptions::class;
    }
}