<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ToastsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Toasts');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'toasts';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'toast-background-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($white, .85)'])
                ]
            ],
            'toast-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'toast-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'toast-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75rem'])
                ]
            ],
            'toast-max-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Max width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '350px'])
                ]
            ],
            'toast-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'toast-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .1)'])
                ]
            ],
            'toast-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large border radius')])
                ]
            ],
            'toast-spacing' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Spacing'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('container padding x')])
                ]
            ],
            'toast-header-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Header color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('Grey 600')])
                ]
            ],
            'toast-header-background-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Header background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($white, .85)'])
                ]
            ],
            'toast-header-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Header border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .05)'])
                ]
            ],
        ];
    }
}