<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ColorsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Colors');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'colors';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'white' => [
                'value' => '#ffffff',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('White')
                ]
            ],
            'black' => [
                'value' => '#000000',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Black')
                ]
            ],
            'blue' => [
                'value' => '#0d6efd',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Blue')
                ]
            ],
            'indigo' => [
                'value' => '#6610f2',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Indigo')
                ]
            ],
            'purple' => [
                'value' => '#6f42c1',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Purple')
                ]
            ],
            'pink' => [
                'value' => '#d63384',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Pink')
                ]
            ],
            'red' => [
                'value' => '#dc3545',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Red')
                ]
            ],
            'orange' => [
                'value' => '#fd7e14',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Orange')
                ]
            ],
            'yellow' => [
                'value' => '#ffc107',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Yellow')
                ]
            ],
            'green' => [
                'value' => '#198754',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Green')
                ]
            ],
            'teal' => [
                'value' => '#20c997',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Teal')
                ]
            ],
            'cyan' => [
                'value' => '#0dcaf0',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Cyan')
                ]
            ],
            'grey-100' => [
                'value' => '#f8f9fa',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 100')
                ]
            ],
            'grey-200' => [
                'value' => '#e9ecef',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 200')
                ]
            ],
            'grey-300' => [
                'value' => '#dee2e6',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 300')
                ]
            ],
            'grey-400' => [
                'value' => '#ced4da',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 400')
                ]
            ],
            'grey-500' => [
                'value' => '#adb5bd',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 500')
                ]
            ],
            'grey-600' => [
                'value' => '#6c757d',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 600')
                ]
            ],
            'grey-700' => [
                'value' => '#495057',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 700')
                ]
            ],
            'grey-800' => [
                'value' => '#343a40',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 800')
                ]
            ],
            'grey-900' => [
                'value' => '#212529',
                'type' => 'color',
                'baseColor' => true,
                'options' => [
                    'label' => $this->t('Grey 900')
                ]
            ],
            'primary' => [
                'type' => 'select',
                'value' => '$blue',
                'options' => [
                    'label' => $this->t('Primary'),
                    'options' => '#colors'
                ]
            ],
            'secondary' => [
                'type' => 'select',
                'value' => '$grey-600',
                'options' => [
                    'label' => $this->t('Secondary'),
                    'options' => '#colors'
                ]
            ],
            'success' => [
                'type' => 'select',
                'value' => '$green',
                'options' => [
                    'label' => $this->t('Success'),
                    'options' => '#colors'
                ]
            ],
            'info' => [
                'type' => 'select',
                'value' => '$cyan',
                'options' => [
                    'label' => $this->t('Info'),
                    'options' => '#colors'
                ]
            ],
            'warning' => [
                'type' => 'select',
                'value' => '$yellow',
                'options' => [
                    'label' => $this->t('Warning'),
                    'options' => '#colors'
                ]
            ],
            'danger' => [
                'type' => 'select',
                'value' => '$red',
                'options' => [
                    'label' => $this->t('Danger'),
                    'options' => '#colors'
                ]
            ],
            'light' => [
                'type' => 'select',
                'value' => '$grey-100',
                'options' => [
                    'label' => $this->t('Light'),
                    'options' => '#colors'
                ]
            ],
            'dark' => [
                'type' => 'select',
                'value' => '$grey-900',
                'options' => [
                    'label' => $this->t('Dark'),
                    'options' => '#colors'
                ]
            ],
            'body-color' => [
                'type' => 'select',
                'value' => '$grey-900',
                'options' => [
                    'label' => $this->t('Body text'),
                    'options' => '#colors'
                ]
            ],
            'body-bg' => [
                'type' => 'select',
                'value' => '$white',
                'options' => [
                    'label' => $this->t('Body background'),
                    'options' => '#colors'
                ]
            ],
            'border-color' => [
                'type' => 'select',
                'value' => '$grey-300',
                'options' => [
                    'label' => $this->t('Borders'),
                    'options' => '#colors'
                ]
            ],
            'text-muted' => [
                'type' => 'select',
                'value' => '$grey-600',
                'options' => [
                    'label' => $this->t('Text muted'),
                    'options' => '#colors'
                ]
            ],
            'headings-color' => [
                'type' => 'select',
                'value' => '$primary',
                'options' => [
                    'label' => $this->t('Headings'),
                    'options' => '#colors'
                ]
            ],
            'link-color' => [
                'type' => 'select',
                'value' => '$primary',
                'options' => [
                    'label' => $this->t('Links'),
                    'options' => '#colors'
                ]
            ],
            'component-active-color' => [
                'type' => 'select',
                'value' => '$white',
                'options' => [
                    'label' => $this->t('Active state'),
                    'options' => '#colors'
                ]
            ],
            'component-active-bg' => [
                'type' => 'select',
                'value' => '$primary',
                'options' => [
                    'label' => $this->t('Active state background'),
                    'options' => '#colors'
                ]
            ]
        ];
    }
}