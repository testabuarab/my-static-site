<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ProgressSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Progress');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'progress';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'progress-height' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Height'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'progress-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 200')])
                ]
            ],
            'progress-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'progress-bar-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Bar color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('white')])
                ]
            ],
            'progress-bar-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Bar background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('primary')])
                ]
            ],
        ];
    }
}