<?php 

namespace Ryssbowh\BootstrapTheme\models\blocks;

use Ryssbowh\BootstrapTheme\models\blockOptions\PoweredByBootstrapOptions;
use Ryssbowh\CraftThemes\models\Block;

class PoweredByBootstrap extends Block
{
    /**
     * @var string
     */
    public static $handle = 'powered-by';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Powered by');
    }

    /**
     * @inheritDoc
     */
    public function getSmallDescription(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getOptionsModel(): string
    {
        return PoweredByBootstrapOptions::class;
    }
}