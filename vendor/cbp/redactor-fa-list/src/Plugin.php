<?php
namespace cbp\redactorFaList;

use cbp\redactorFaList\models\Settings;
use Craft;
use craft\redactor\events\RegisterPluginPathsEvent;
use craft\redactor\Field;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\web\View;

class Plugin extends \craft\base\Plugin
{
    // Public Methods
    // =========================================================================

    public function init() {
        parent::init();

        if (!Craft::$app->request->isConsoleRequest && Craft::$app->request->isCpRequest) {
            $view = Craft::$app->getView();
            // the registerJsVar method lets us add js to the page
            $view->registerJsVar('FAListIcons', $this->getSettings()->icons, View::POS_HEAD);

            Event::on(Field::class, Field::EVENT_REGISTER_PLUGIN_PATHS, [$this, 'RegisterPluginPath']);
        }
    }

  /**
   * @throws InvalidConfigException
   */
  public function RegisterPluginPath(RegisterPluginPathsEvent $event) {
        $event->paths[] = \dirname(__DIR__) . '/src/resources/';

        $view = Craft::$app->getView();
        $styles = $this->getSettings()->styles;

        //adds Font Awesome font styles
        if(!empty($styles)){
            foreach($styles as $style){
                if(is_array($style) && isset($style['src'])){
                    $view->registerCssFile($style['src'], $style['params'] ?? []);
                }
                elseif(is_string($style)) $view->registerCssFile($style);
            }
        }
    }

    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }
}