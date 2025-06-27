<?php
namespace abmat\tinymce;

use Craft;
use craft\base\Model;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use yii\base\Event;
use abmat\tinymce\models\Settings;

/**
 * TinyMCE plugin.
 * @method static Plugin getInstance()
 *
 * @author ABM
 * @since 1.0
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public string $schemaVersion = '1.0.0';

    public bool $hasCpSettings = true;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function(RegisterComponentTypesEvent $e) {
                $e->types[] = Field::class;
            }
        );
    }

    protected function createSettingsModel(): ?Model
	{
		return new Settings();
	}

	protected function settingsHtml(): ?string
	{
		return Craft::$app->view->renderTemplate('abm-tinymce/_settings', [
				'plugin' => $this,
				'settings' => $this->getSettings(),
		]);
	}
}
