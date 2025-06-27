<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class BadgesSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Badges');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'badges';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'badge-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'badge-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.35em'])
                ]
            ],
            'badge-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.65em'])
                ]
            ],
            'badge-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ]
        ];
    }
}