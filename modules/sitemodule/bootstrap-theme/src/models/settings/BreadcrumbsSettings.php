<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class BreadcrumbsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Breadcrumbs');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'breadcrumbs';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'breadcrumb-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0'])
                ]
            ],
            'breadcrumb-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '0'])
                ]
            ],
            'breadcrumb-item-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Item padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5rem'])
                ]
            ],
            'breadcrumb-margin-bottom' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Margin bottom'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'breadcrumb-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('nothing')])
                ]
            ],
            'breadcrumb-divider-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Divider color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ],
            'breadcrumb-active-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Active color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ],
            'breadcrumb-divider' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Divider'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '/'])
                ],
                'valueCallback' => function ($value) {
                    return 'quote("' . $value . '")';
                }
            ],
            'breadcrumb-divider-flipped' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Flipped divider'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('divider')])
                ],
                'valueCallback' => function ($value) {
                    return 'quote("' . $value . '")';
                }
            ],
            'breadcrumb-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('nothing')])
                ]
            ]
        ];
    }
}