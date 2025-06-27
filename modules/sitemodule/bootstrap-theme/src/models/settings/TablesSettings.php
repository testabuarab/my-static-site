<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class TablesSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Tables');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'tables';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'table-cell-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Cell padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'table-cell-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Cell padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'table-cell-padding-y-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small tables cell padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'table-cell-padding-x-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small tables cell padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'table-cell-vertical-align' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Cell vertical align'),
                    'tip' => $this->t('Valid values : (baseline, sub, super,text-top, text-bottom, middle, top, bottom) or any length or percentage value'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'top'])
                ]
            ],
            'table-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Text color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text color')])
                ]
            ],
            'table-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('transparent')])
                ]
            ],
            'table-accent-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Accented table background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('transparent')])
                ]
            ],
            'table-th-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Header cells font weight')
                ]
            ],
            'table-striped-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Striped table color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('table text color')])
                ]
            ],
            'table-striped-bg-factor' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Striped table background factor'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.1'])
                ]
            ],
            'table-striped-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Striped table background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value, $settings) {
                    $bgFactor = $settings->variables['table-striped-bg-factor'] ?? null;
                    $bgFactor = $bgFactor ? '$table-striped-bg-factor' : '.05';
                    return 'rgba(' . $value . ', ' . $bgFactor . ')';
                }
            ],
            'table-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active table color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('table text color')])
                ]
            ],
            'table-active-bg-factor' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Active table background factor'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.1'])
                ],
            ],
            'table-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active table background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value, $settings) {
                    $bgFactor = $settings->variables['table-active-bg-factor'] ?? null;
                    $bgFactor = $bgFactor ? '$table-active-bg-factor' : '.05';
                    return 'rgba(' . $value . ', ' . $bgFactor . ')';
                }
            ],
            'table-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Hover table color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('table text color')])
                ]
            ],
            'table-hover-bg-factor' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hover table background factor'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.075'])
                ],
            ],
            'table-hover-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Hover table background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value, $settings) {
                    $bgFactor = $settings->variables['table-hover-bg-factor'] ?? null;
                    $bgFactor = $bgFactor ? '$table-hover-bg-factor' : '.05';
                    return 'rgba(' . $value . ', ' . $bgFactor . ')';
                }
            ],
            'table-border-factor' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border factor'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.075'])
                ]
            ],
            'table-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'table-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('borders')])
                ]
            ],
            'table-caption-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Caption color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('muted')])
                ]
            ],
            'table-bg-scale' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Background scale'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '-80%'])
                ]
            ]
        ];
    }
}