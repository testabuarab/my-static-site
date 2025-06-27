<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\UserRenderedOptions;

class UserCardOptions extends UserRenderedOptions
{
    /**
     * @inheritDoc
     */
    public function defineOptions(): array
    {
        $options = $this->defineViewModeOptions();
        $options['disposition'] = [
            'field' => 'bootstrap-zones',
            'itemsFrom' => '#field-viewModeUid:select',
            'zones' => [
                'header' => \Craft::t('bootstrap-theme', 'Header'),
                'content' => \Craft::t('bootstrap-theme', 'Main content'),
                'footer' => \Craft::t('bootstrap-theme', 'Footer')
            ],
            'defaultZone' => 'content',
            'label' => \Craft::t('bootstrap-theme', 'Disposition'),
            'required' => true
        ];
        return $options;
    }
}