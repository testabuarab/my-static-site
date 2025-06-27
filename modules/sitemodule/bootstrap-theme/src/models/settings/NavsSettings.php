<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class NavsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Navs');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'navs';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'nav-link-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Links padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'nav-link-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Links padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'nav-link-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Links color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links')])
                ]
            ],
            'nav-link-hover-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Links hover color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('links hover color')])
                ],
                'valueCallback' => function ($value, $settings) {
                    $per = $settings->variables['link-shade-percentage'] ?? null;
                    $per = $per ? '$link-shade-percentage' : '20%';
                    return 'shift-color(' . $value . ', ' . $per . ')';
                }
            ],
            'nav-link-disabled-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Disabled links color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ],
            'nav-tabs-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Nav tabs border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 300')])
                ]
            ],
            'nav-tabs-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Nav tabs border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'nav-tabs-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Nav tabs border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'nav-tabs-link-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Nav tabs links active color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 700')])
                ]
            ],
            'nav-tabs-link-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Nav tabs links active background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body background color')])
                ]
            ],
            'nav-pills-border-radius' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Nav pills border radius'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'nav-pills-link-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Nav pills active color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state')])
                ]
            ],
            'nav-pills-link-active-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Nav pills active background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('active state background')])
                ]
            ],
            'navbar-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar padding y'),
                    'instructions' => $this->t('Defaults to {default} * .5', ['default' => $this->t('spacer')])
                ]
            ],
            'navbar-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0'])
                ]
            ],
            'navbar-nav-link-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar links padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'navbar-nav-link-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar links padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'navbar-brand-margin-end' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar end margin'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'navbar-toggler-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar toggler padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'navbar-toggler-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar toggler padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75rem'])
                ]
            ],
            'navbar-toggler-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar toggler border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('buttons border radius')])
                ]
            ],
            'navbar-toggler-focus-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Navbar toggler focus width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('buttons focus width')])
                ]
            ],
        ];
    }
}