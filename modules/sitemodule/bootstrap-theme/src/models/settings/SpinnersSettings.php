<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class SpinnersSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Spinners');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'spinners';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'spinner-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '2rem'])
                ]
            ],
            'spinner-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('width')])
                ]
            ],
            'spinner-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25em'])
                ]
            ],
            'spinner-animation-speed' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Animation speed'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75s'])
                ]
            ],
            'spinner-width-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small spinner width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'spinner-height-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small spinner height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small spinner width')])
                ]
            ],
            'spinner-border-width-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small spinner border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.2em'])
                ]
            ]
        ];
    }
}