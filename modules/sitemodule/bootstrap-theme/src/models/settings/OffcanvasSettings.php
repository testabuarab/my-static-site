<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class OffcanvasSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Offcanvas');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'offcanvas';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'offcanvas-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals inner padding')])
                ]
            ],
            'offcanvas-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals inner padding')])
                ]
            ],
            'offcanvas-horizontal-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Horizontal width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '400px'])
                ]
            ],
            'offcanvas-horizontal-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Vertical height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '30vh'])
                ]
            ],
            'offcanvas-transition-duration' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Transition duration'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.3s'])
                ]
            ],
            'offcanvas-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals content border color')])
                ]
            ],
            'offcanvas-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals content border width')])
                ]
            ],
            'offcanvas-bg-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals content background color')])
                ]
            ],
            'offcanvas-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals content color')])
                ]
            ],
            'offcanvas-backdrop-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Backdrop background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals backdrop background color')])
                ]
            ],
            'offcanvas-backdrop-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Backdrop opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('modals backdrop opacity')])
                ]
            ]
        ];
    }
}