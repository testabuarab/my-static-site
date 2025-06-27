<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\MatrixCardOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\MatrixDefault;

/**
 * Renders a matrix field as card
 */
class MatrixCard extends MatrixDefault
{
    /**
     * @inheritDoc
     */
    public static $handle = 'matrix-card';

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
        return \Craft::t('bootstrap-theme', 'Card');
    }

    /**
     * @inheritDoc
     */
    public function getOptionsModel(): string
    {
        return MatrixCardOptions::class;
    }
}