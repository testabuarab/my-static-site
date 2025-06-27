<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class CloseSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Close');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'close';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'btn-close-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1em'])
                ]
            ],
            'btn-close-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('close buttons width')])
                ]
            ],
            'btn-close-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25em'])
                ]
            ],
            'btn-close-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('close buttons padding y')])
                ]
            ],
            'btn-close-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Close buttons color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('black')])
                ]
            ],
            'btn-close-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.5'])
                ]
            ],
            'btn-close-hover-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons hover opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.75'])
                ]
            ],
            'btn-close-focus-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Close buttons focus opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1'])
                ]
            ],
            'btn-close-focus-opacity' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Disabled close buttons opacity'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25'])
                ]
            ]
        ];
    }
}