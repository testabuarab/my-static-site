<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class MiscSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Misc');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'misc';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'enable-caret' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable carets'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-rounded' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable rounded'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-shadows' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable shadows'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'no']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-gradients' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable gradients'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'no']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-transitions' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable transitions'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-reduced-motion' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable reduced motion'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-smooth-scroll' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable smooth scroll'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-grid-classes' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable grid classes'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-cssgrid' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable css grid'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'no']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-button-pointers' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable button pointers'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-rfs' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable rfs'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-validation-icons' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable validation icons'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-negative-margins' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable negative margins'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'no']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-deprecation-messages' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable deprecation messages'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'enable-important-utilities' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Enable important utilities'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'yes']),
                    'options' => [
                        '' => $this->t('Default'),
                        'true' => $this->t('Yes'),
                        'false' => $this->t('No'),
                    ]
                ]
            ],
            'spacer' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Spacer'),
                    'tip' => $this->t('This controls margins & paddings of most elements'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'gradient' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Gradient color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')]),
                ],
                'valueCallback' => function ($value) {
                    return 'linear-gradient(180deg, rgba(' . $value .', .15), rgba(' . $value .', 0))';
                }
            ],
            'box-shadow' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Box shadow color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value) {
                    return '0 .5rem 1rem rgba(' . $value . ', .15)';
                }
            ],
            'box-shadow-sm' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Small box shadow color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value) {
                    return '0 .125rem .25rem rgba(' . $value . ', .075)';
                }
            ],
            'box-shadow-lg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Large box shadow color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value) {
                    return '0 1rem 3rem rgba(' . $value . ', .175)';
                }
            ],
            'box-shadow-inset' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Box shadow inset color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')]),
                ],
                'valueCallback' => function ($value) {
                    return 'inset 0 1px 2px rgba(' . $value . ', .075)';
                }
            ],
            'blockquote-footer-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Blockquote footer'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')]),
                    'options' => '#colors'
                ]
            ],
            'blockquote-margin-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Blockquote margin y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Base border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1px'])
                ]
            ],
            'border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Base border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'border-radius-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius small elements'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.2rem'])
                ]
            ],
            'border-radius-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius large elements'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.3erm'])
                ]
            ],
            'border-radius-pill' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius pill'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '50rem'])
                ]
            ],
            'paragraph-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Paragraph bottom margin'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'caret-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Carets width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.3em'])
                ]
            ],
            'link-decoration' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Link decoration'),
                    'options' => [
                        '' => $this->t('Default'),
                        'underline' => $this->t('Underline'),
                        'none' => $this->t('None')
                    ],
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'underline'])
                ]
            ],
            'link-hover-decoration' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Link hover decoration'),
                    'options' => [
                        '' => $this->t('Default'),
                        'underline' => $this->t('Underline'),
                        'none' => $this->t('None')
                    ],
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'underline'])
                ]
            ],
            'link-shade-percentage' => [
                'type' => 'text',
                'options' => [
                    'type' => 'number',
                    'label' => $this->t('Links shade percentage'),
                    'min' => 0,
                    'step' => 1,
                    'unit' => '%',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '20'])
                ],
            ],
            'link-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Links hover color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links')]),
                ],
                'valueCallback' => function ($value, $settings) {
                    $per = $settings->variables['link-shade-percentage'] ?? null;
                    $per = $per ? '$link-shade-percentage' : '20%';
                    return 'shift-color(' . $value . ', ' . $per . ')';
                }
            ],
            'input-btn-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.375rem'])
                ]
            ],
            'input-btn-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75rem'])
                ]
            ],
            'input-btn-padding-y-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs & buttons padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'input-btn-padding-x-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small inputs & buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'input-btn-padding-y-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs & buttons padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'input-btn-padding-x-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large inputs & buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'input-btn-focus-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons focus width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'input-btn-focus-color-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons focus color opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25'])
                ]
            ],
            'input-btn-focus-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Inputs & buttons focus color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state')]),
                ],
                'valueCallback' => function ($value, $settings) {
                    $bgFactor = $settings->variables['input-btn-focus-color-opacity'] ?? null;
                    $bgFactor = $bgFactor ? '$input-btn-focus-color-opacity' : '.25';
                    return 'rgba(' . $value . ', ' . $bgFactor . ')';
                }
            ],
            'input-btn-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inputs & buttons focus border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'hr-margin-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hr margin y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'hr-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Hr color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherits']),
                    'options' => '#colors'
                ]
            ],
            'hr-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hr height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'hr-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Hr opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25'])
                ]
            ],
            'legend-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Legend margin bottom'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'mark-padding' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Mark padding'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.2em'])
                ]
            ],
            'mark-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Mark background'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '#fcf8e3']),
                    'options' => '#colors'
                ]
            ],
            'list-inline-padding' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('List inline padding'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'code-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Code color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('pink')])
                ]
            ],
            'kbd-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Kbd padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.2rem'])
                ]
            ],
            'kbd-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Kbd padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.4rem'])
                ]
            ],
            'kbd-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Kbd color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'kbd-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Kbd background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 900')])
                ]
            ],
            'pre-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Pre color'),
                    'options' => '#colors'
                ]
            ],
            'grid-columns' => [
                'type' => 'text',
                'options' => [
                    'min' => 1,
                    'step' => 1,
                    'type' => 'number',
                    'label' => $this->t('Grid columns'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('12')])
                ]
            ],
            'grid-gutter-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Grid gutter width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.5rem'])
                ]
            ],
            'grid-row-columns' => [
                'type' => 'text',
                'options' => [
                    'min' => 1,
                    'step' => 1,
                    'type' => 'number',
                    'label' => $this->t('Grid row columns'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('6')])
                ]
            ],
            'container-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Container padding x'),
                    'instructions' => $this->t('Defaults to grid gutter width * .5')
                ]
            ],
            'grid-breakpoints' => [
                'type' => 'textarea',
                'options' => [
                    'label' => $this->t('Grid breakpoints'),
                    'instructions' => $this->t('One breakpoint per line separated by commas, example : "sm: 576px,"')
                ]
            ],
            'container-max-widths' => [
                'type' => 'textarea',
                'options' => [
                    'label' => $this->t('Container max widths'),
                    'instructions' => $this->t('One width per line separated by commas, example : "sm: 540px,"')
                ]
            ],
        ];
    }
}