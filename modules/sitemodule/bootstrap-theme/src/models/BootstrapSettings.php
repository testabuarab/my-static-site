<?php
namespace Ryssbowh\BootstrapTheme\models;

use Ryssbowh\BootstrapTheme\exceptions\BootstrapSettingsException;
use Ryssbowh\BootstrapTheme\interfaces\BootstrapSettingsInterface;
use craft\base\Model;

abstract class BootstrapSettings extends Model implements BootstrapSettingsInterface
{
    public $definitions = [];

    public function __get($name): array
    {
        if (!isset($this->definitions[$name])) {
            throw BootstrapSettingsException::noName($this, $name);
        }
        return $this->definitions[$name];
    }

    public function __set($name, $value)
    {
        $this->definitions[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->definitions[$name]);
    }

    protected function t(string $string, array $variables = [])
    {
        return \Craft::t('bootstrap-theme', $string, $variables);
    }
}