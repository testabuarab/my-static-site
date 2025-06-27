<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class AlertsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Alertssss');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'alerts';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'alert-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'alert-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'alert-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Margin-bottom'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'alert-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'alert-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'alert-bg-scale' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Background scale'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '-80%'])
                ]
            ],
            'alert-border-scale' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border scale'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '-70%'])
                ]
            ],
            'alert-color-scale' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Color scale'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '40%'])
                ]
            ]
        ];
    }
}