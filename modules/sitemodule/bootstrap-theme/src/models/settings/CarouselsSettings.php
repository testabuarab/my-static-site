<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class CarouselsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Carousels');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'carousels';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'carousel-control-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Controls color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'carousel-control-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Controls width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '15%'])
                ]
            ],
            'carousel-control-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Controls opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5'])
                ]
            ],
            'carousel-control-hover-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Controls hover opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.9'])
                ]
            ],
            'carousel-indicator-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Indicators width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '30px'])
                ]
            ],
            'carousel-indicator-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Indicators height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '3px'])
                ]
            ],
            'carousel-indicator-hit-area-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Indicators hit area height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '10px'])
                ]
            ],
            'carousel-indicator-spacer' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Indicators spacer'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '3px'])
                ]
            ],
            'carousel-indicator-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Indicators opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5'])
                ]
            ],
            'carousel-indicator-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active indicator background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'carousel-indicator-active-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Active indicators opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1'])
                ]
            ],
            'carousel-caption-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Caption width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '70%'])
                ]
            ],
            'carousel-caption-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Caption color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'carousel-caption-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Caption padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.25rem'])
                ]
            ],
            'carousel-caption-spacer' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Caption spacer'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.25rem'])
                ]
            ],
            'carousel-control-icon-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Caption icon width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '2rem'])
                ]
            ],
            'carousel-transition-duration' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Transition duration'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.6s'])
                ]
            ],
        ];
    }
}