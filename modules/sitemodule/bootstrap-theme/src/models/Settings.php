<?php
namespace Ryssbowh\BootstrapTheme\models;

use Ryssbowh\BootstrapTheme\Theme;
use Ryssbowh\BootstrapTheme\events\SettingsEvent;
use Ryssbowh\BootstrapTheme\exceptions\BootstrapSettingsException;
use Ryssbowh\BootstrapTheme\interfaces\BootstrapSettingsInterface;
use craft\base\Model;
use craft\helpers\FileHelper;
use craft\helpers\StringHelper;
use craft\web\UploadedFile;

class Settings extends Model
{
    const EVENT_SETTINGS = 'event-settings';

    /**
     * @var boolean
     */
    public $compileScss = true;

    /**
     * @var boolean
     */
    public $rebuildScssOnSettings = true;

    /**
     * @var array
     */
    public $variables = [];

    /**
     * @var array
     */
    public $fonts = [];

    /**
     * @var string
     */
    public $logo = '';

    /**
     * @var string
     */
    public $favicon = '';

    /**
     * @var bool
     */
    public $deleteLogo;

    /**
     * @var bool
     */
    public $deleteFavicon;

    /**
     * @var string
     */
    public $resourceFilePath = '@Ryssbowh/BootstrapTheme/assets/src/scss/resources-settings.scss';

    /**
     * @var string
     */
    public $scssEntryPoint = 'assets/src/scss/app.scss';

    /**
     * @var array
     */
    protected $_fontsDefinitions;

    /**
     * @var array
     */
    protected $_settings;

    /**
     * Get a bootstrap settings class or all of them
     * 
     * @param  string|null $handle
     * @return array|BootstrapSettingsInterface|null
     */
    public function getSettings(?string $handle = null)
    {
        if ($this->_settings === null) {
            $this->registerSettings();
        }
        return $handle ? $this->_settings[$handle] ?? null : $this->_settings;
    }

    /**
     * Get settings tabs
     * 
     * @return array
     */
    public function getTabs(): array
    {
        $tabs = [];
        foreach ($this->getSettings() as $handle => $settings) {
            $tabs[$handle] = [
                'label' => $settings->getName(),
                'url' => '#settings-' . $handle
            ];
        }
        return $tabs;
    }

    /**
     * get the fonts definitions
     * 
     * @return array
     */
    public function getFontsDefinitions(): array
    {
        if ($this->_fontsDefinitions === null) {
            $this->registerSettings();
        }
        return $this->_fontsDefinitions;
    }

    /**
     * @inheritDoc
     */
    public function defineRules(): array
    {
        return [
            ['logo', 'file', 'extensions' => ['jpg', 'jpeg', 'gif', 'png', 'svg']],
            ['favicon', 'file', 'extensions' => ['jpg', 'jpeg', 'gif', 'png', 'svg', 'ico']],
            ['deleteLogo', function () {
                FileHelper::unlink(\Craft::getAlias($this->logo));
                $this->logo = '';
            }],
            ['deleteFavicon', function () {
                FileHelper::unlink(\Craft::getAlias($this->favicon));
                $this->favicon = '';
            }]
        ];
    }

    /**
     * @inheritDoc
     */
    public function afterValidate()
    {
        if ($file = UploadedFile::getInstanceByName('settings[logo]')) {
            $path = '@themesWebPath/bootstrap-theme/logo.' . $file->extension;
            $file->saveAs(\Craft::getAlias($path));
            $this->logo = $path;
        }
        if ($file = UploadedFile::getInstanceByName('settings[favicon]')) {
            $path = '@themesWebPath/bootstrap-theme/favicon.' . $file->extension;
            $file->saveAs(\Craft::getAlias($path));
            $this->favicon = $path;
        }
    }

    /**
     * Get the logo url, returns default one if custom is not uploaded
     * 
     * @return string
     */
    public function getLogoUrl(): string
    {   
        if ($this->logo) {
            $path = \Craft::getAlias($this->logo);
            if (file_exists($path)) {
                $url = str_replace(\Craft::getAlias('@themesWebPath'), \Craft::getAlias('@themesWeb'), $path);
                return $url . '?v=' . filemtime($path);
            }
        }
        return Theme::$plugin->getAssetUrl('assets/images/logo.svg');
    }

    /**
     * Get the favicon url, returns default one if custom is not uploded
     * 
     * @return string
     */
    public function getFaviconUrl(): string
    {   
        if ($this->favicon) {
            $path = \Craft::getAlias($this->favicon);
            if (file_exists($path)) {
                $url = str_replace(\Craft::getAlias('@themesWebPath'), \Craft::getAlias('@themesWeb'), $path);
                return $url . '?v=' . filemtime($path);
            }
        }
        return Theme::$plugin->getAssetUrl('assets/images/favicon.png');
    }

    /**
     * Write css root file in the @themesWebPath folder
     */
    public function writeScssResourceFile(bool $useDefaults = false)
    {
        $content = '@import "~bootstrap/scss/_functions.scss";' . "\n";
        foreach ($this->settings as $namespace => $setting) {
            foreach ($setting->definitions as $name => $definition) {
                $value = $useDefaults ? ($this->variables[$name] ?? $definition['value'] ?? null) : ($this->variables[$name] ?? null);
                $isRgba = ($definition['type'] == 'selectrgba');
                if ($isRgba and !($value['color'] ?? false)) {
                    continue;
                }
                if (!$value) {
                    continue;
                }
                if ($definition['type'] == 'color' and !StringHelper::startsWith($value, '#')) {
                    $value = '#' . $value;
                }
                if (isset($definition['valueCallback'])) {
                    $content .= "\$" . $name . ': ' . $definition['valueCallback']($value, $this) . ";\n";
                } elseif($isRgba) {
                    $content .= "\$" . $name . ': rgba(' . $value['color'] . ', ' . ($value['opacity'] ?? 1) . ");\n";
                } else {
                    $content .= "\$" . $name . ': ' . $value . ($def['options']['unit'] ?? '') . ";\n";
                }
            }
        }
        FileHelper::writeToFile(\Craft::getAlias($this->resourceFilePath), $content);
    }

    /**
     * Register settings through events to allow other plugins to register css roots or fonts
     */
    public function registerSettings()
    {
        $event = new SettingsEvent;
        $this->trigger(self::EVENT_SETTINGS, $event);
        $defined = [];
        foreach ($event->all() as $settings) {
            foreach ($settings->definitions as $name => $def) {
                if (isset($defined[$name])) {
                    throw BootstrapSettingsException::defined($settings->getName(), $name, $defined[$name]);
                }
                $defined[$name] = $settings->getName();
            }
        }
        $this->_settings = $event->all();
        $this->_fontsDefinitions = $event->fonts;
    }

    /**
     * Get defined fonts labels indexed by font names
     * 
     * @return aray
     */
    public function getAllFontsLabels(bool $withDefault = true): array
    {
        $fonts = [];
        foreach ($this->getFontsDefinitions() as $font) {
            $fonts = array_merge($fonts, $font['fonts']);
        }
        $fonts = array_combine($fonts, $fonts);
        return $withDefault ? ['' => \Craft::t('bootstrap-theme', 'Default')] + $fonts : $fonts;
    }

    /**
     * Get defined colors labels indexed by color names
     * 
     * @return aray
     */
    public function getBaseColorsLabels(string $color, bool $includeDefault): array
    {
        $colors = [];
        foreach ($this->getSettings('colors')->definitions as $name => $definition) {
            if ($color == $name) {
                //Let's not show colors that are defined after the current color, or the compiling will fail
                break;
            }
            $colors['$' . $name] = $definition['options']['label'] ?? '**no label**';
        }
        asort($colors);
        $defaults = [];
        if ($includeDefault) {
            $defaults[''] = \Craft::t('bootstrap-theme', 'Default');
        }
        $defaults['transparent'] = \Craft::t('bootstrap-theme', 'Transparent');
        return $defaults + $colors;
    }

    /**
     * Register the selected fonts on the view
     */
    public function registerFont()
    {
        $registered = [];
        $domains = [];
        foreach ($this->fontsDefinitions as $definition) {
            foreach ($this->fonts as $font) {
                if(in_array($font, $definition['fonts']) and !in_array($definition['url'], $registered)) {
                    $parsed = parse_url($definition['url']);
                    $domain = $parsed['scheme'] . '://' . $parsed['host'];
                    if (!in_array($domain, $domains)) {
                        \Craft::$app->view->registerLinkTag(['rel' => 'preconnect', 'href' => $domain]);
                        $domains[] = $domain;
                    }
                    \Craft::$app->view->registerLinkTag(['href' => $definition['url'], 'crossorigin' => true, 'rel' => 'stylesheet']);
                }
            }
        }
    }
}