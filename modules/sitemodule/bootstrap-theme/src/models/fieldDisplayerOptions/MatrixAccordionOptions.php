<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\FieldDisplayerOptions;
use Ryssbowh\CraftThemes\services\LayoutService;

class MatrixAccordionOptions extends FieldDisplayerOptions
{
    /**
     * @inheritDoc
     */
    public function defineOptions(): array
    {
        $matrix = $this->displayer->field;
        $options['keepOpen'] = [
            'field' => 'lightswitch',
            'label' => \Craft::t('bootstrap-theme', 'Items stay open when another item is opened')
        ];
        $options['allOpen'] = [
            'field' => 'lightswitch',
            'label' => \Craft::t('bootstrap-theme', 'Show all items as opened')
        ];
        foreach ($matrix->types as $type) {
            $items = [];
            foreach ($type->fields as $field) {
                $items[] = [
                    'name' => $field->name,
                    'uid' => $field->uid,
                    'hidden' => $field->hidden or $field->visuallyHidden
                ];
            }
            $options['disposition-' . $type->type->uid] = [
                'field' => 'bootstrap-zones',
                'items' => $items,
                'zones' => [
                    'header' => \Craft::t('bootstrap-theme', 'Header'),
                    'content' => \Craft::t('bootstrap-theme', 'Main content')
                ],
                'defaultZone' => 'content',
                'label' => \Craft::t('bootstrap-theme', 'Disposition for {type}', ['type' => $type->type->name]),
                'required' => true
            ];
        }
        return $options;
    }
}