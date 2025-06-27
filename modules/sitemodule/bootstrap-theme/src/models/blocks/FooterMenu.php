<?php
namespace Ryssbowh\BootstrapTheme\models\blocks;

use Ryssbowh\BootstrapTheme\models\blockOptions\FooterMenuOptions;
use Ryssbowh\CraftThemes\models\Block;

class FooterMenu extends Block
{
    /**
     * @var string
     */
    public static $handle = 'footer-menu';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'Footer menu');
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
        return FooterMenuOptions::class;
    }
}