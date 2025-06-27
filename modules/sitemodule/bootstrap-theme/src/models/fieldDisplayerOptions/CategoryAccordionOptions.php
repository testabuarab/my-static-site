<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\CategoryRenderedOptions;
use Ryssbowh\CraftThemes\services\LayoutService;

class CategoryAccordionOptions extends CategoryRenderedOptions
{
    /**
     * @inheritDoc
     */
    public function defineOptions(): array
    {
        $options = array_merge([
            'keepOpen' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Items stay open when another item is opened')
            ],
            'allOpen' => [
                'field' => 'lightswitch',
                'label' => \Craft::t('bootstrap-theme', 'Show all items as opened')
            ]
        ], $this->defineViewModeOptions());
        $options['disposition'] = [
            'field' => 'bootstrap-zones',
            'itemsFrom' => '#field-viewModeUid:select',
            'zones' => [
                'header' => \Craft::t('bootstrap-theme', 'Header'),
                'content' => \Craft::t('bootstrap-theme', 'Main content')
            ],
            'defaultZone' => 'content',
            'label' => \Craft::t('bootstrap-theme', 'Disposition'),
            'required' => true
        ];
        return $options;
    }
}