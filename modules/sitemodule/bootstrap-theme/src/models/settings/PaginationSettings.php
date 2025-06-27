<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class PaginationSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Pagination');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'pagination';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'pagination-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('.375rem')])
                ]
            ],
            'pagination-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('.75rem')])
                ]
            ],
            'pagination-padding-y-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small pagination padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('.25rem')])
                ]
            ],
            'pagination-padding-x-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small pagination padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('.5rem')])
                ]
            ],
            'pagination-padding-y-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large pagination padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('.75rem')])
                ]
            ],
            'pagination-padding-x-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large pagination padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('1.5rem')])
                ]
            ],
            'pagination-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links')])
                ]
            ],
            'pagination-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'pagination-border-radius-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small pagination border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small border radius')])
                ]
            ],
            'pagination-border-radius-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large pagination border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large border radius')])
                ]
            ],
            'pagination-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'pagination-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 300')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-focus-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Focus color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links hover color')])
                ],
                'valueCallback' => function ($value, $settings) {
                    $per = $settings->variables['link-shade-percentage'] ?? null;
                    $per = $per ? '$link-shade-percentage' : '20%';
                    return 'shift-color(' . $value . ', ' . $per . ')';
                }
            ],
            'pagination-focus-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Focus background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Focus color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links hover color')])
                ],
                'valueCallback' => function ($value, $settings) {
                    $per = $settings->variables['link-shade-percentage'] ?? null;
                    $per = $per ? '$link-shade-percentage' : '20%';
                    return 'shift-color(' . $value . ', ' . $per . ')';
                }
            ],
            'pagination-hover-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Hover background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-hover-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Hover border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 300')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state background')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-active-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state background')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-disabled-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-disabled-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')]),
                    'options' => '#colors'
                ]
            ],
            'pagination-disabled-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')]),
                    'options' => '#colors'
                ]
            ]
        ];
    }
}