<?php
namespace Ryssbowh\BootstrapTheme\exceptions;

class BootstrapThemeException extends \Exception
{
    public static function rootDefined(string $name)
    {
        return new static($name  . ' root is already defined');
    }
}