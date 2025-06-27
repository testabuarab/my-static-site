<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\MatrixAccordionOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\MatrixDefault;

/**
 * Renders a matrix field as accordion
 */
class MatrixAccordion extends MatrixDefault
{
    /**
     * @inheritDoc
     */
    public static $handle = 'matrix-accordion';

    /**
     * @inheritDoc
     */
    public static function isDefault(string $fieldClass): bool
    {
        return false;
    }

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
        return MatrixAccordionOptions::class;
    }
}