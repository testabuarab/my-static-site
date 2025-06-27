<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions\UserCardOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayers\UserRendered;

/**
 * Renders a user field as a card
 */
class UserCard extends UserRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'user-card';

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
        return UserCardOptions::class;
    }
}