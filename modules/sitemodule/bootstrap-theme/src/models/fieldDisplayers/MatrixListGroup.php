<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\CraftThemes\models\fieldDisplayers\MatrixDefault;

/**
 * Renders a matrix field as a list group
 */
class MatrixListGroup extends MatrixDefault
{
    /**
     * @inheritDoc
     */
    public static $handle = 'matrix-listgroup';

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
        return \Craft::t('bootstrap-theme', 'List group');
    }
}