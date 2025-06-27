<?php

namespace Ryssbowh\RedactorFa;

use craft\i18n\PhpMessageSource;
use Ryssbowh\RedactorFa\assets\bundles\SettingsBundle;
use Ryssbowh\RedactorFa\models\Settings;
use Ryssbowh\RedactorFa\services\FaService;
use craft\base\Model;
use craft\base\Plugin;
use craft\redactor\Field;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

class RedactorFa extends Plugin
{
    /**
     * @var Example
     */
    public static $plugin;

    /**
     * @var bool
     */
    public bool $hasCpSettings = true;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        $this->registerComponents();
        $this->modifyRedactor();
        $this->registerTwig();
    }

    /**
     * Register plugins components
     */
    protected function registerComponents()
    {
        $this->setComponents([
            'fa' => FaService::class
        ]);
    }

    /**
     * Redactor config events
     */
    protected function modifyRedactor()
    {
        if (\Craft::$app->request->isCpRequest) {
            Event::on(Field::class, Field::EVENT_REGISTER_PLUGIN_PATHS, function (Event $e) {
                $e->paths[] = \Craft::getAlias('@Ryssbowh/RedactorFa/assets/dist/redactor-plugins');
            });
            Event::on(Field::class, Field::EVENT_DEFINE_REDACTOR_CONFIG, function (Event $e) {
                $e->config = RedactorFa::$plugin->fa->modifyRedactorConfig($e->config);
            });
        }
    }

    /**
     * Adds a twig variable
     */
    protected function registerTwig()
    {
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $e) {
            $e->sender->set('redactorFa', RedactorFa::$plugin->fa);
        });
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        \Craft::$app->view->registerAssetBundle(SettingsBundle::class);
        return \Craft::$app->view->renderTemplate(
            'redactor-fa-api/settings',
            [
                'settings' => $this->getSettings(),
                'faVersionOptions' => $this->fa->versions
            ]
        );
    }
}
