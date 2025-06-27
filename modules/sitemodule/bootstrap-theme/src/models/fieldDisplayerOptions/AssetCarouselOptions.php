<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\AssetRenderedOptions;

class AssetCarouselOptions extends AssetRenderedOptions
{
    /**
     * @inheritDoc
     */
    public function defineDefaultValues(): array
    {
        return array_merge(parent::defineDefaultValues(), [
            'showControls' => true,
            'showIndicators' => false,
            'disableTouch' => false,
            'fadeAnimation' => false,
            'autoStart' => true,
            'interval' => 5000,
            'pause' => true,
            'infinite' => true,
            'disableKeyboard' => false,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function defineOptions(): array
    {
        return array_merge(parent::defineOptions(), [
            'showControls' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Show controls')
            ],
            'showIndicators' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Show indicators')
            ],
            'disableTouch' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Disable touch swipe')
            ],
            'fadeAnimation' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Fade instead of slide')
            ],
            'autoStart' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Autostart cycling')
            ],
            'interval' => [
                'field' => 'text',
                'type' => 'number',
                'min' => 100,
                'step' => 100,
                'required' => true,
                'label' => \Craft::t('bootstrap-theme', 'Interval between each slide (ms)')
            ],
            'pause' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Pause on hover')
            ],
            'infinite' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Infinite')
            ],
            'disableKeyboard' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Disable keyboard')
            ]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            [['showControls', 'showIndicators', 'disableTouch', 'fadeAnimation', 'autoStart', 'pause', 'infinite', 'disableKeyboard'], 'boolean', 'trueValue' => true, 'falseValue' => false],
            ['interval', 'integer', 'min' => 100]
        ]);
    }
}