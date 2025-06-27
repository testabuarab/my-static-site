<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ModalsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Modals');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'modals';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'modal-inner-padding' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Inner padding'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('spacer')])
                ]
            ],
            'modal-footer-margin-between' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Footer margin between'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'modal-dialog-margin' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Dialog margin'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'modal-dialog-margin-y-sm-up' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Dialog margin y small devices and more'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.75rem'])
                ]
            ],
            'modal-content-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Content color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'inherit'])
                ]
            ],
            'modal-content-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Content background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'modal-content-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Content border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .2)'])
                ]
            ],
            'modal-content-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Content border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'modal-content-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Content border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('large border radius')])
                ]
            ],
            'modal-backdrop-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Backdrop background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')])
                ]
            ],
            'modal-backdrop-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Backdrop opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5'])
                ]
            ],
            'modal-header-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Header border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('borders')])
                ]
            ],
            'modal-footer-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Footer border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('header border color')])
                ]
            ],
            'modal-header-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Header border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('content border width')])
                ]
            ],
            'modal-footer-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Footer border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('header border width')])
                ]
            ],
            'modal-header-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('header padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inner padding')])
                ]
            ],
            'modal-header-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('header padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('inner padding')])
                ]
            ],
            'modal-sm' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Small modal width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '300px'])
                ]
            ],
            'modal-md' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Medium modal width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '500px'])
                ]
            ],
            'modal-lg' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Large modal width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '800px'])
                ]
            ],
            'modal-xl' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Extra large modal width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1140px'])
                ]
            ],
        ];
    }
}