<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class TooltipsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Tooltips');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'tooltips';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'tooltip-max-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Max width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '200px'])
                ]
            ],
            'tooltip-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {spacer} * 0.25', ['spacer' => $this->t('spacer')])
                ]
            ],
            'tooltip-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {spacer} * 0.5', ['spacer' => $this->t('spacer')])
                ]
            ],
            'tooltip-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'white'])
                ]
            ],
            'tooltip-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'black'])
                ]
            ],
            'tooltip-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'tooltip-margin' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Margin'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0'])
                ]
            ],
            'tooltip-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0.9'])
                ]
            ],
            'tooltip-arrow-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Arrow width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.8rem'])
                ]
            ],
            'tooltip-arrow-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Arrow height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.4rem'])
                ]
            ],
            'tooltip-arrow-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Arrow color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('tooltip background color')])
                ]
            ],
        ];
    }
}