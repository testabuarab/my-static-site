<?php 

namespace Ryssbowh\BootstrapTheme\models\blockProviders;

use Ryssbowh\BootstrapTheme\models\blocks\FooterMenu;
use Ryssbowh\BootstrapTheme\models\blocks\MainMenu;
use Ryssbowh\BootstrapTheme\models\blocks\PoweredByBootstrap;
use Ryssbowh\CraftThemes\base\BlockProvider;

class BootstrapBlockProvider extends BlockProvider
{
    /**
     * @var array
     */
    protected $_definedBlocks = [
        PoweredByBootstrap::class,
        MainMenu::class,
        FooterMenu::class
    ];

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Bootstrap Theme');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'bootstrap';
    }
}