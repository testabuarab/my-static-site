<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ButtonsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Buttons');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'buttons';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'btn-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons padding y')])
                ]
            ],
            'btn-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons padding x')])
                ]
            ],
            'btn-padding-y-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small buttons padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs & buttons padding y')])
                ]
            ],
            'btn-padding-x-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs & buttons padding x')])
                ]
            ],
            'btn-padding-y-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large buttons padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs & buttons padding y')])
                ]
            ],
            'btn-padding-x-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs & buttons padding x')])
                ]
            ],
            'btn-white-space' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('White space'),
                    'instructions' => $this->t('Set to `nowrap` to prevent text wrapping')
                ]
            ],
            'btn-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons border width')])
                ]
            ],
            'btn-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'btn-border-radius-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small buttons border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small border radius')])
                ]
            ],
            'btn-border-radius-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large buttons border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large border radius')])
                ]
            ],
            'btn-focus-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Focus width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons focus width')])
                ]
            ],
            'btn-link-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Link buttons color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links')])
                ]
            ],
            'btn-link-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Link buttons hover color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links hover color')])
                ],
                'valueCallback' => function ($value, $settings) {
                    $per = $settings->variables['link-shade-percentage'] ?? null;
                    $per = $per ? '$link-shade-percentage' : '20%';
                    return 'shift-color(' . $value . ', ' . $per . ')';
                }
            ],
            'btn-disabled-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Disabled buttons opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.65'])
                ]
            ],
            'btn-link-disabled-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ],
            'btn-hover-bg-shade-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hover background shade amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '15']),
                    'unit' => '%'
                ]
            ],
            'btn-hover-bg-tint-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hover background tint amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '15']),
                    'unit' => '%'
                ]
            ],
            'btn-hover-border-shade-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hover border shade amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '20']),
                    'unit' => '%'
                ]
            ],
            'btn-hover-border-tint-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hover border tint amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '10']),
                    'unit' => '%'
                ]
            ],
            'btn-active-bg-shade-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Active background shade amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '20']),
                    'unit' => '%'
                ]
            ],
            'btn-active-bg-tint-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Active background tint amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '20']),
                    'unit' => '%'
                ]
            ],
            'btn-active-border-shade-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Active border shade amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '25']),
                    'unit' => '%'
                ]
            ],
            'btn-active-border-tint-amount' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Active border tint amount'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '10']),
                    'unit' => '%'
                ]
            ],
        ];
    }
}