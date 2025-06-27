<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class FormsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Forms');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'forms';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'form-text-margin-top' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Form text margin top'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'form-text-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Form text color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('muted')]),
                    'options' => '#colors'
                ]
            ],
            'input-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons padding y')])
                ]
            ],
            'input-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons padding x')])
                ]
            ],
            'input-padding-y-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small input & buttons padding y')])
                ]
            ],
            'input-padding-x-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small input & buttons padding x')])
                ]
            ],
            'input-padding-y-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large input & buttons padding y')])
                ]
            ],
            'input-padding-x-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large input & buttons padding x')])
                ]
            ],
            'input-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs text color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text color')]),
                    'options' => '#colors'
                ]
            ],
            'input-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body background color')]),
                    'options' => '#colors'
                ]
            ],
            'input-disabled-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled inputs background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')]),
                    'options' => '#colors'
                ]
            ],
            'input-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'input-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'input-border-radius-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small border radius')])
                ]
            ],
            'input-border-radius-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large border radius')])
                ]
            ],
            'input-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 400')]),
                    'options' => '#colors'
                ]
            ],
            'input-disabled-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled inputs border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('nothing')]),
                    'options' => '#colors'
                ]
            ],
            'input-placeholder-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs placeholders color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')]),
                    'options' => '#colors'
                ]
            ],
            'input-plaintext-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs plain text color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text color')]),
                    'options' => '#colors'
                ]
            ],
            'input-focus-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs focus background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input background color')]),
                    'options' => '#colors'
                ]
            ],
            'input-focus-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs focus color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input color')]),
                    'options' => '#colors'
                ]
            ],
            'input-focus-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs focus width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons focus width color')])
                ]
            ],
            'form-label-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Labels margin bottom'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            
            'form-label-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Labels text color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')]),
                    'options' => '#colors'
                ]
            ],
            'form-color-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Color form control width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '3rem'])
                ]
            ],
            'form-check-input-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Checks input border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1em'])
                ]
            ],
            'form-check-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Checks input margin bottm'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.125rem'])
                ]
            ],
            'form-check-label-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checks label color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-label-cursor' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Checks label cursor'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')])
                ]
            ],
            'form-check-input-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checks input background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input background color')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-input-border' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checks input border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value) {
                    return '1px solid rgba(' . $value . ', .25)';
                }
            ],
            'form-check-input-disabled-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Disabled checks input opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5'])
                ]
            ],
            'form-check-label-disabled-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Disabled checks label opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('disabled checks input opacity')])
                ]
            ],
            'form-check-btn-check-disabled-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Disabled checks buttons opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('disabled buttons opacity')])
                ]
            ],
            'form-check-input-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Checkboxes border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25em'])
                ]
            ],
            'form-check-input-focus-border' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checks inputs focus border'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('focus border color')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-radio-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Radios border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '50%'])
                ]
            ],
            'form-check-input-checked-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checked inputs color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active component')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-input-checked-bg-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checked inputs background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active component background')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-input-checked-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checked inputs border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('checked inputs background color')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-input-indeterminate-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Indeterminate checks inputs color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active component')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-input-indeterminate-bg-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Indeterminate checks inputs background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active component background')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-input-indeterminate-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Indeterminate checks inputs border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('indeterminate checks inputs background color')]),
                    'options' => '#colors'
                ]
            ],
            'form-check-inline-margin-end' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inline checks margin end'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'form-switch-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Switch color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .25)']),
                    'options' => '#colors'
                ]
            ],
            'form-switch-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Switch width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.2em'])
                ]
            ],
            'form-switch-padding-start' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Switch padding start'),
                    'instructions' => $this->t('Defaults to {width} + .5em', ['width' => $this->t('switch width')])
                ]
            ],
            'form-switch-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Switch border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('switch width')])
                ]
            ],
            'form-switch-checked-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Checked switch color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state')]),
                    'options' => '#colors'
                ]
            ],
            'input-group-addon-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Group addon padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input padding y')])
                ]
            ],
            'input-group-addon-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Group addon padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input padding x')])
                ]
            ],
            'input-group-addon-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Group addon color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs color')]),
                    'options' => '#colors'
                ]
            ],
            'input-group-addon-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Group addon background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')]),
                    'options' => '#colors'
                ]
            ],
            'input-group-addon-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Group addon border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs border color')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input padding y')])
                ]
            ],
            'form-select-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input padding x')])
                ]
            ],
            'form-select-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Selects color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs color')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Selects background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs background color')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-disabled-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled selects color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-disabled-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled selects background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-disabled-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled selects border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('disabled inputs border color')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs border width')])
                ]
            ],
            'form-select-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Selects border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs border color')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs border radius')])
                ]
            ],
            'form-select-focus-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Selects focus border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs focus border color')]),
                    'options' => '#colors'
                ]
            ],
            'form-select-padding-y-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small selects padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs padding y')])
                ]
            ],
            'form-select-padding-x-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small selects padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs padding x')])
                ]
            ],
            'form-select-border-radius-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small selects border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs border radius')])
                ]
            ],
            'form-select-padding-y-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large selects padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs padding y')])
                ]
            ],
            'form-select-padding-x-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large selects padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs padding x')])
                ]
            ],
            'form-select-border-radius-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large selects border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs border radius')])
                ]
            ],
            'form-range-track-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range track width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '100%'])
                ]
            ],
            'form-range-track-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range track height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'form-range-track-cursor' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range track cursor'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'pointer'])
                ]
            ],
            'form-range-track-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Range track background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 300')]),
                    'options' => '#colors'
                ]
            ],
            'form-range-track-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range track border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'form-range-thumb-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range thumb width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'form-range-thumb-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range thumb height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('range thumb width')])
                ]
            ],
            'form-range-thumb-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Range thumb background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state')]),
                    'options' => '#colors'
                ]
            ],
            'form-range-thumb-border' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range thumb border'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0'])
                ]
            ],
            'form-range-thumb-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Range thumb border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'form-range-thumb-disabled-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled range thumb background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 500')]),
                    'options' => '#colors'
                ]
            ],
            'form-file-button-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('File button color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input color')]),
                    'options' => '#colors'
                ]
            ],
            'form-file-button-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('File button background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('group addon background color')]),
                    'options' => '#colors'
                ]
            ],
            'form-floating-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Floating padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs padding x')])
                ]
            ],
            'form-floating-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Floating padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'form-floating-input-padding-t' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Floating input padding top'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.625rem'])
                ]
            ],
            'form-floating-input-padding-b' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Floating input padding bottom'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.625rem'])
                ]
            ],
            'form-floating-input-padding-b' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Floating input opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.65'])
                ]
            ],
            'form-feedback-margin-top' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Feedback margin top'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('form text margin top')])
                ]
            ],
            'form-feedback-valid-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Valid feedback color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('success')]),
                    'options' => '#colors'
                ]
            ],
            'form-feedback-invalid-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Invalid feedback color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('danger')]),
                    'options' => '#colors'
                ]
            ],
            'form-feedback-icon-valid-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Valid feedback icon color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('valid feedback color')]),
                    'options' => '#colors'
                ]
            ],
            'form-feedback-icon-invalid-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Invalid feedback icon color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('invalid feedback color')]),
                    'options' => '#colors'
                ]
            ],
        ];
    }
}