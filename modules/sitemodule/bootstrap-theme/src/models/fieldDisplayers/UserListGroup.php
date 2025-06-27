<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayers;

use Ryssbowh\CraftThemes\models\fieldDisplayers\UserRendered;

/**
 * Renders a user field as a list group
 */
class UserListGroup extends UserRendered
{
    /**
     * @inheritDoc
     */
    public static $handle = 'user-listgroup';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return \Craft::t('bootstrap-theme', 'List group');
    }
}