<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\UserRenderedOptions;
use Ryssbowh\CraftThemes\services\LayoutService;

class UserAccordionOptions extends UserRenderedOptions
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

    /**
     * @inheritDoc
     */
    public function defineRules(): array
    {
        if (LayoutService::$isInstalling) {
            return [];
        }
        return array_merge($this->defineViewModeRules(), [
            ['headerDisplays', function () {
                if (!$this->headerDisplays or sizeof($this->headerDisplays) == 0) {
                    $this->addError('headerDisplays', \Craft::t('bootstrap-theme', 'Header displays are required'));
                }
            }, 'skipOnEmpty' => false]
        ]);
    }
}