<?php
use Ryssbowh\BootstrapTheme\models\Settings;

class MySettingsTab extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'My tab';
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'my-tab'
    }

    /**
     * @inheritDoc
     */
    public function init()
    {
        //Valid values for 'type': text, date, time, color, dateTime, textarea, select, selectrgba, multiselect, checkbox, lightswitch, radioGroup, checkboxSelect, checkboxGroup, autosuggest
        $this->definitions = [
            'my-variable' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('My variable'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('default')])
                ]
            ],
            //Select dropdown using all defined colors :
            'my-color' => [
                'type' => 'select',
                'value' => '$blue',
                'options' => [
                    'label' => $this->t('My color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'Blue']),
                    'values' => '#colors'
                ]
            ],
            //Rgba colors also shows an opacity input :
            'rgba-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Rgba color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .125)']),
                    'options' => '#colors'
                ]
            ],
            //Select dropdown using all defined fonts
            'my-font' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('My font'),
                    'options' => '#fonts',
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                ]
            ],
            //Custom function to generate the value
            'rgba-color' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Custom variable'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'my-mixin($variable, 10%)'])
                ],
                'valueCallback' => function ($value, $settings) {
                    return 'my-mixin(' . $value . ', 10%)';
                }
            ],
        ];
    }
}

Event::on(Settings::class, Settings::EVENT_SETTINGS, function (SettingsEvent $e) {
    $e->add(new MySettingsTab);
});
