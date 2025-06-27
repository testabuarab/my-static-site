<?php
namespace Ryssbowh\BootstrapTheme;

use Ryssbowh\CraftThemes\base\ThemePreferences as BaseThemePreferences;
use Ryssbowh\CraftThemes\interfaces\BlockInterface;
use Ryssbowh\CraftThemes\interfaces\FieldInterface;
use Ryssbowh\CraftThemes\interfaces\GroupInterface;
use Ryssbowh\CraftThemes\interfaces\RegionInterface;

class ThemePreferences extends BaseThemePreferences
{
    protected $_regionClasses = [
        'before-header' => ['col-12'],
        'header-left' => ['col-12', 'col-lg-4'],
        'header-middle' => ['col-12', 'col-lg-4'],
        'header-right' => ['col-12', 'col-lg-4'],
        'after-header' => ['col-12'],
        'banner' => [],
        'before-content' => ['col-12'],
        'after-content' => ['col-12'],
        'before-footer' => ['col-12'],
        'footer-left' => ['col-12', 'col-lg-4', 'text-center', 'text-lg-start'],
        'footer-middle' => ['col-12', 'col-lg-4', 'text-center'],
        'footer-right' => ['col-12', 'col-lg-4', 'text-center', 'text-lg-end'],
        'after-footer' => ['col-12'],
    ];

    /**
     * @inheritDoc
     */
    public function getFieldContainerClasses(FieldInterface $field): array
    {
        $classes = ['mb-3'];
        if ($field->displayer::$handle == 'title_title') {
            $classes[] = 'text-center';
        }
        return array_merge(parent::getFieldContainerClasses($field), $classes);
    }

    /**
     * @inheritDoc
     */
    public function getGroupContainerClasses(GroupInterface $group): array
    {
        return array_merge(parent::getGroupContainerClasses($group), ['mb-3']);
    }

    /**
     * @inheritDoc
     */
    public function getGroupLabelClasses(GroupInterface $group): array
    {
        return array_merge(parent::getGroupLabelClasses($group), ['fw-bold']);
    }

    /**
     * @inheritDoc
     */
    public function getFieldLabelClasses(FieldInterface $field): array
    {
        return array_merge(parent::getFieldLabelClasses($field), ['fw-bold']);
    }

    /**
     * @inheritDoc
     */
    public function getRegionClasses(RegionInterface $region): array
    {
        return array_merge(parent::getRegionClasses($region), $this->_regionClasses[$region->handle] ?? []);
    }

    /**
     * @inheritDoc
     */
    public function getBlockClasses(BlockInterface $block): array
    {
        return array_merge(parent::getBlockClasses($block), ['mb-3']);
    }
}