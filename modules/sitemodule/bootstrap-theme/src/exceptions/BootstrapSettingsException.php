<?php
namespace Ryssbowh\BootstrapTheme\exceptions;

use Ryssbowh\BootstrapTheme\interfaces\BootstrapSettingsInterface;

class BootstrapSettingsException extends \Exception
{
    public static function noName(BootstrapSettingsInterface $settings, string $name)
    {
        return new static($settings->getName() . ' bootstrap settings doesn\'t define setting ' . $name);
    }

    public static function defined(string $settingsFrom, string $handle, string $settings)
    {
        return new static($settingsFrom . ': bootstrap setting \'' . $handle . '\' is already defined in ' . $settings);
    }

    public static function settingsDefined(string $handle)
    {
        return new static('Bootstrap settings \'' . $handle . '\' is already defined');
    }
}