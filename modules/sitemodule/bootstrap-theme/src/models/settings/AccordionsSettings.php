<?php
namespace Ryssbowh\BootstrapTheme\models\settings;

use Ryssbowh\BootstrapTheme\models\BootstrapSettings;

class AccordionsSettings extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->t('Accordions');
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'accordions';
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->definitions = [
            'accordion-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1rem'])
                ]
            ],
            'accordion-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.25rem'])
                ]
            ],
            'accordion-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body text color')])
                ]
            ],
            'accordion-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Background color'),
                    'options' => '#colors',
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('body background color')])
                ]
            ],
            'accordion-border-radius' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border radius'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border radius')])
                ]
            ],
            'accordion-border-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Border width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('base border width')])
                ]
            ],
            'accordion-border-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Border color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .125)']),
                    'options' => '#colors'
                ]
            ],
            'accordion-body-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Body padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('padding y')])
                ]
            ],
            'accordion-body-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Body padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('padding x')])
                ]
            ],
            'accordion-button-padding-y' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Button padding y'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('padding y')])
                ]
            ],
            'accordion-button-padding-x' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Button padding x'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('padding x')])
                ]
            ],
            'accordion-button-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Button color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('accordion color')]),
                    'options' => '#colors'
                ]
            ],
            'accordion-button-bg' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Button background color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('accordion background color')]),
                    'options' => '#colors'
                ]
            ],
            'accordion-icon-width' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Icons width'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => '1.25rem'])
                ]
            ],
            'accordion-icon-color' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('Icons color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('accordion button color')]),
                    'options' => '#colors'
                ]
            ],
        ];
    }
}