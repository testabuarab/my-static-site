<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class DropdownsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Dropdowns');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'dropdowns';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'dropdown-min-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Minimum width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '10rem'])
                ]
            ],
            'dropdown-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0'])
                ]
            ],
            'dropdown-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'dropdown-spacer' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Spacer'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.125rem'])
                ]
            ],
            'dropdown-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Text color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text color')])
                ]
            ],
            'dropdown-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'dropdown-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'dropdown-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'dropdown-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .15)']),
                    'options' => '#colors',
                ]
            ],
            'dropdown-divider-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Divider color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('dropdowns border color')])
                ]
            ],
            'dropdown-divider-margin-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Divider margin y'),
                    'instructions' => $this->t('Defaults to {spacer} * .5', ['spacer' => $this->t('spacer')])
                ]
            ],
            'dropdown-link-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Link color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 900')])
                ]
            ],
            'dropdown-link-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Links hover color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('dropdowns links color')])
                ],
                'valueCallback' => function ($value, $settings) {
                    return 'shade-color(' . $value . ', 10%)';
                }
            ],
            'dropdown-link-hover-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Link hover background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')])
                ]
            ],
            'dropdown-link-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active link color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active component')])
                ]
            ],
            'dropdown-link-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active link background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active component background')])
                ]
            ],
            'dropdown-link-disabled-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled link color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 500')])
                ]
            ],
            'dropdown-item-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item padding y'),
                    'instructions' => $this->t('Defaults to {spacer} * .25', ['spacer' => $this->t('spacer')])
                ]
            ],
            'dropdown-item-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'dropdown-header-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Header color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ]
        ];
    }
}