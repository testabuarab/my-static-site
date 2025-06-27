<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class CardsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Cards');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'cards';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'card-spacer-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Spacing y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'card-spacer-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Spacing x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'card-title-spacer-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Title spacing y'),
                    'instructions' => $this->t('Defaults to {spacer} * .5', ['spacer' => $this->t('spacer')])
                ]
            ],
            'card-cap-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Cap padding y'),
                    'instructions' => $this->t('Defaults to {spacer} * .5', ['spacer', $this->t('card spacer')])
                ]
            ],
            'card-cap-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Cap padding y'),
                    'instructions' => $this->t('Defaults to {spacer} x', ['spacer' => $this->t('card spacer')])
                ]
            ],
            'card-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')])
                ]
            ],
            'card-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')])
                ]
            ],
            'card-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'card-cap-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Cap color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')]),
                    'options' => '#colors',
                ]
            ],
            'card-cap-bg' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Cap background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .03)']),
                    'options' => '#colors',
                ]
            ],
            'card-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'card-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'card-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .125)']),
                    'options' => '#colors',
                ]
            ],
        ];
    }
}