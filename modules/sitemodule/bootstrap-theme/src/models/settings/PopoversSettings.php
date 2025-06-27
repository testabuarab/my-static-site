<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class PopoversSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Popovers');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'popovers';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'popover-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'popover-max-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Max width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '276px'])
                ]
            ],
            'popover-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'popover-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .2)'])
                ]
            ],
            'popover-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults {default}', ['default' =>$this->t('large border radius')])
                ]
            ],
            'popover-header-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Header color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('headings')])
                ]
            ],
            'popover-header-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Header padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'popover-header-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Header padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'popover-body-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Body color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text color')])
                ]
            ],
            'popover-body-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Body padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'popover-body-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Body padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'popover-arrow-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Arrow width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'popover-arrow-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Arrow height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'popover-arrow-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Arrow color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('popover background color')])
                ]
            ],
        ];
    }
}