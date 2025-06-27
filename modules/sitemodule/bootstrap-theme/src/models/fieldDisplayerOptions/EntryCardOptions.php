<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\EntryRenderedOptions;
use Ryssbowh\CraftThemes\services\LayoutService;

class EntryCardOptions extends EntryRenderedOptions
{
    /**
     * Entry types
     * @var array
     */
    protected $_types;

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
        ], $this->defineViewModesOptions());
        foreach ($this->getTypes() as $type) {
            $options['disposition-' . $type->uid] = [
                'field' => 'bootstrap-zones',
                'itemsFrom' => '#field-viewMode-' . $type->uid . ':select',
                'zones' => [
                    'header' => \Craft::t('bootstrap-theme', 'Header'),
                    'content' => \Craft::t('bootstrap-theme', 'Main content'),
                    'footer' => \Craft::t('bootstrap-theme', 'Footer')
                ],
                'defaultZone' => 'content',
                'label' => \Craft::t('bootstrap-theme', 'Disposition for {type}', ['type' => $type->section->name . ' : ' . $type->name]),
                'required' => true
            ];
        }
        return $options;
    }

    /**
     * Get all defined entry types on the field
     * 
     * @return array
     */
    protected function getTypes(): array
    {
        if ($this->_types === null) {
            $sources = $this->displayer->field->craftField->sources;
            $types = [];
            if ($sources == '*') {
                $sections = \Craft::$app->sections->getAllSections();
                foreach ($sections as $section) {
                    foreach ($section->getEntryTypes() as $type) {
                        $types[] = $type;
                    }
                }
            } else {
                foreach ($sources as $source) {
                    if ($source == 'singles') {
                        $sections = \Craft::$app->sections->getSectionsByType('single');
                        $types = [];
                        foreach ($sections as $section) {
                            $types[] = $section->getEntryTypes()[0];
                        }
                    } else {
                        $elems = explode(':', $source);
                        $section = \Craft::$app->sections->getSectionByUid($elems[1]);
                        if ($section) {
                            $type = $section->getEntryTypes()[0];
                            $types[] = $section->getEntryTypes()[0];
                        }
                    }
                }
            }
            $this->_types = $types;
        }
        return $this->_types;;
    }
}