<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class ImagesSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Images');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'images';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'thumbnail-padding' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Thumbnails padding'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => '.25rem'])
                ]
            ],
            'thumbnail-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Thumbnails background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body background')])
                ]
            ],
            'thumbnail-border-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Thumbnails border color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 300')])
                ]
            ],
            'thumbnail-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Thumbnails border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'thumbnail-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Thumbnails border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'figure-caption-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Figure captions color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('grey 600')])
                ]
            ],
        ];
    }
}