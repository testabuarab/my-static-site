<?php
namespace Ryssbowh\BootstrapTheme\models\fieldDisplayerOptions;

use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\AssetRenderedOptions;

class AssetCardOptions extends AssetRenderedOptions
{
    /**
     * Volumes
     * @var array
     */
    protected $_volumes;

    /**
     * @inheritDoc
     */
    public function defineOptions(): array
    {
        $options = $this->defineViewModesOptions();
        foreach ($this->getVolumes() as $volume) {
            $options['disposition-' . $volume->uid] = [
                'field' => 'bootstrap-zones',
                'itemsFrom' => '#field-viewMode-' . $volume->uid . ':select',
                'zones' => [
                    'header' => \Craft::t('bootstrap-theme', 'Header'),
                    'content' => \Craft::t('bootstrap-theme', 'Main content'),
                    'footer' => \Craft::t('bootstrap-theme', 'Footer')
                ],
                'defaultZone' => 'content',
                'label' => \Craft::t('bootstrap-theme', 'Disposition for {type}', ['type' => $volume->name]),
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
    protected function getVolumes(): array
    {
        if ($this->_volumes === null) {
            $source = $this->displayer->field->craftField->sources;
            if ($source == '*') {
                $this->_volumes = \Craft::$app->volumes->getAllVolumes();
            } else {
                $this->_volumes = [];
                foreach ($source as $source) {
                    $elems = explode(':', $source);
                    $this->_volumes[] = \Craft::$app->volumes->getVolumeByUid($elems[1]);
                }
            }
        }
        return $this->_volumes;
    }
}