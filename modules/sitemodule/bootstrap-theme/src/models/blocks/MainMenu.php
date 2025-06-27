<?php 

namespace Ryssbowh\BootstrapTheme\models\blocks;

use Ryssbowh\BootstrapTheme\models\blockOptions\MainMenuOptions;
use Ryssbowh\CraftThemes\models\Block;

class MainMenu extends Block
{
    /**
     * @var string
     */
    public static $handle = 'main-menu';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Main menu');
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
        return MainMenuOptions::class;
    }
}