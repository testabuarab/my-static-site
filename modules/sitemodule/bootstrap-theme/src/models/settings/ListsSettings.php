<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ListsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Lists');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'lists';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'list-group-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 900')])
                ]
            ],
            'list-group-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'list-group-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .125)'])
                ]
            ],
            'list-group-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'list-group-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'list-group-item-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item padding y'),
                    'instructions' => $this->t('Defaults to {spacer} * .5', ['spacer' => $this->t('spacer')])
                ]
            ],
            'list-group-item-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item padding x'),
                    'instructions' => $this->t('Defaults to {spacer}', ['spacer' => $this->t('spacer')])
                ]
            ],
            'list-group-item-bg-scale' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item background scale'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '-80%'])
                ]
            ],
            'list-group-item-color-scale' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item color scale'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '40%'])
                ]
            ],
            'list-group-hover-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Item hover background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 100')])
                ]
            ],
            'list-group-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active item color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state')])
                ]
            ],
            'list-group-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active item background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state background')])
                ]
            ],
            'list-group-active-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active item border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active item background color')])
                ]
            ],
            'list-group-disabled-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled item color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ],
            'list-group-disabled-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled item background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('background color')])
                ]
            ],
            'list-group-action-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Actions color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 700')])
                ]
            ],
            'list-group-action-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Actions hover color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('actions color')])
                ]
            ],
            'list-group-action-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active actions color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text')])
                ]
            ],
            'list-group-action-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active actions background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')])
                ]
            ],
        ];
    }
}