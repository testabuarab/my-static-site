<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class TypographySettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Typography');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'typography';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'body-text-align' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Text alignment'),
                    'options' => [
                        '' => $this->t('Default'),
                        'left' => $this->t('Left'),
                        'center' => $this->t('Center'),
                        'right' => $this->t('Right'),
                        'justify' => $this->t('Justify'),
                    ]
                ]
            ],
            'font-family-base' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Body font'),
                    'options' => '#fonts',
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                ],
                'valueCallback' => function ($value, $settings) {
                    return "\"$value\"" . ', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                }
            ],
            'font-size-base' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Body font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'small-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small font size'),
                    'tip' => $this->t('Used on small tags, code tags, blockquote footers, abbreviations, figure captions and form texts'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.875rem'])
                ]
            ],
            'font-size-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small elements font size'),
                    'tip' => $this->t('Small elements include tooltips, popovers and optionally inputs, selects and buttons'),
                    'instructions' => $this->t('Defaults to {body} * 0.875', ['body' => $this->t('body font size')])
                ]
            ],
            'font-size-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large elements font size'),
                    'tip' => $this->t('Large elements include navbar brand, navbar toggler and optionally inputs, selects and buttons'),
                    'instructions' => $this->t('Defaults to {body} * 1.25', ['body' => $this->t('body font size')])
                ]
            ],
            'font-weight-lighter' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Lighter font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'lighter'])
                ]
            ],
            'font-weight-light' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Light font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '300'])
                ]
            ],
            'font-weight-normal' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Normal font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '400'])
                ]
            ],
            'font-weight-bold' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Bold font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '700'])
                ]
            ],
            'font-weight-bolder' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Bolder font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'bolder'])
                ]
            ],
            'font-weight-base' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Base font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('normal font weight')])
                ]
            ],
            'line-height-base' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Line height'),
                    'step' => 0.1,
                    'min' => 0,
                    'type' => 'number',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.5'])
                ]
            ],
            'line-height-base-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small line height'),
                    'step' => 0.1,
                    'min' => 0,
                    'type' => 'number',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.25'])
                ]
            ],
            'line-height-base-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large line height'),
                    'step' => 0.1,
                    'min' => 0,
                    'type' => 'number',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '2'])
                ]
            ],
            'headings-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Headings margin bottom'),
                    'instructions' => $this->t('Defaults to {spacer} * .5', ['spacer' => $this->t('spacer')])
                ]
            ],
            'headings-font-family' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Headings font'),
                    'options' => '#fonts',
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                ]
            ],
            'headings-font-style' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Headings font style'),
                    'options' => [
                        '' => $this->t('Inherit'),
                        'normal' => $this->t('Normal'),
                        'italic' => $this->t('Italic'),
                        'oblique' => $this->t('Oblique'),
                    ]
                ]
            ],
            'headings-font-weight' => [
                'type' => 'text',
                'options' => [
                    'type' => 'number',
                    'label' => $this->t('Headings font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '500'])
                ]
            ],
            'headings-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Headings line height'),
                    'step' => 0.1,
                    'min' => 0,
                    'type' => 'number',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.2'])
                ]
            ],
            'h1-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('H1 font size'),
                    'instructions' => $this->t('Defaults to {body} * 2.5', ['body' => $this->t('body font size')])
                ]
            ],
            'h2-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('H2 font size'),
                    'instructions' => $this->t('Defaults to {body} * 2', ['body' => $this->t('body font size')])
                ]
            ],
            'h3-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('H3 font size'),
                    'instructions' => $this->t('Defaults to {body} * 1.75', ['body' => $this->t('body font size')])
                ]
            ],
            'h4-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('H4 font size'),
                    'instructions' => $this->t('Defaults to {body} * 1.5', ['body' => $this->t('body font size')])
                ]
            ],
            'h5-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('H5 font size'),
                    'instructions' => $this->t('Defaults to {body} * 1.25', ['body' => $this->t('body font size')])
                ]
            ],
            'h6-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('H6 font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body font size')])
                ]
            ],
            'lead-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Lead font size'),
                    'instructions' => $this->t('Defaults to {body} * 1.25', ['body' => $this->t('body font size')])
                ]
            ],
            'lead-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Lead font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '300'])
                ]
            ],
            'display-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Display font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '300'])
                ]
            ],
            'display-line height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Display line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('headings line height')])
                ]
            ],
            'sub-sup-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Sub & sup font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75em'])
                ]
            ],
            'blockquote-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Blockquote font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body font size')])
                ]
            ],
            'blockquote-footer-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Blockquote footer font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small font size')])
                ]
            ],
            'legend-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Legends font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.5rem'])
                ]
            ],
            'legend-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Legends font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'dt-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Dt font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('font weight bold')])
                ]
            ],
            'nested-kbd-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Nested kbd font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('font weight bold')])
                ]
            ],
            'input-btn-font-family' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs & buttons font'),
                    'options' => '#fonts',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body font')])
                ]
            ],
            'input-btn-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body font size')])
                ]
            ],
            'input-btn-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body line height')])
                ]
            ],
            'input-btn-font-size-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs & buttons font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small elements font size')])
                ]
            ],
            'input-btn-font-size-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs & buttons font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large elements font size')])
                ]
            ],
            'btn-font-family' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Buttons font'),
                    'options' => '#fonts',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons font')]),
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                ]
            ],
            'btn-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Buttons line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons line height')])
                ]
            ],
            'btn-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Buttons font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs & buttons font size')])
                ]
            ],
            'btn-font-size-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small buttons font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs & buttons font size')])
                ]
            ],
            'btn-font-size-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large buttons font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs & buttons font size')])
                ]
            ],
            'btn-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Buttons font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('normal font weight')]),
                    'type' => 'number',
                    'min' => 100,
                    'step' => 100
                ]
            ],
            'form-text-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Form text font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small font size')])
                ]
            ],
            'form-text-font-style' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Form text font style'),
                    'options' => [
                        '' => $this->t('Inherit'),
                        'normal' => $this->t('Normal'),
                        'italic' => $this->t('Italic'),
                        'oblique' => $this->t('Oblique'),
                    ]
                ]
            ],
            'form-text-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Form text font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'form-label-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Labels font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'form-label-font-style' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Labels font style'),
                    'options' => [
                        '' => $this->t('Inherit'),
                        'normal' => $this->t('Normal'),
                        'italic' => $this->t('Italic'),
                        'oblique' => $this->t('Oblique'),
                    ]
                ]
            ],
            'form-label-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Labels font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'input-font-family' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs font'),
                    'options' => '#fonts',
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons font')])
                ]
            ],
            'input-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons line height')])
                ]
            ],
            'input-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons font size')])
                ]
            ],
            'input-font-size-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small input & buttons font size')])
                ]
            ],
            'input-font-size-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small input & buttons font size')])
                ]
            ],
            'input-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('input & buttons font weight')]),
                    'type' => 'number',
                    'step' => 100,
                    'min' => 100
                ]
            ],
            'input-group-addon-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs group addons font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs font weight')]),
                    'type' => 'number',
                    'step' => 100,
                    'min' => 100
                ]
            ],
            'form-select-font-family' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Selects font'),
                    'options' => '#fonts',
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs font')])
                ]
            ],
            'form-select-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs font weight')])
                ]
            ],
            'form-select-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs line height')])
                ]
            ],
            'form-select-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Selects font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inputs font size')])
                ]
            ],
            'form-select-font-size-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small selects font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small inputs font size')])
                ]
            ],
            'form-select-font-size-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large selects font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large inputs font size')])
                ]
            ],
            'form-floating-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Form floating line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.25'])
                ]
            ],
            'form-feedback-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Form feedback font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('form text font size')])
                ]
            ],
            'form-feedback-font-style' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Form feedback font style'),
                    'options' => [
                        '' => $this->t('Default'),
                        'normal' => $this->t('Normal'),
                        'italic' => $this->t('Italic'),
                        'oblique' => $this->t('Oblique'),
                    ],
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('form text font style')])
                ]
            ],
            'nav-link-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Nav link font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'nav-link-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Nav link font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'navbar-brand-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar brand font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large elements font size')])
                ]
            ],
            'navbar-toggler-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar toggler font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large elements font size')])
                ]
            ],
            'dropdown-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Dropdowns font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body font size')])
                ]
            ],
            'tooltip-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Tooltips font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small elements font size')])
                ]
            ],
            'popover-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Popovers font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small elements font size')])
                ]
            ],
            'toast-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Toasts font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.875rem'])
                ]
            ],
            'badge-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Badges font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75em'])
                ]
            ],
            'badge-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Badges font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('bold font weight')])
                ]
            ],
            'modal-title-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Modal titles line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base line height')])
                ]
            ],
            'offcanvas-title-line-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Offcanvas titles line height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modal titles line height')])
                ]
            ],
            'alert-link-font-weight' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Alert links font weight'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large font weight')])
                ]
            ],
            'progress-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Progress font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('{base} * .75', ['base' => $this->t('body font size')])])
                ]
            ],
            'figure-caption-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Figure captions font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small font size')])
                ]
            ],
            'breadcrumb-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Breadcrumbs font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inherit')])
                ]
            ],
            'code-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Code font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('small font size')])
                ]
            ],
            'kbd-font-size' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Kbd font size'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('code font size')])
                ]
            ],
        ];
    }
}