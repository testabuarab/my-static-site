<?php

namespace Ryssbowh\RedactorFa\assets\bundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class SettingsBundle extends AssetBundle
{
    public $sourcePath = '@Ryssbowh/RedactorFa/assets/dist';

    public $js = [
        'settings.js'
    ];

    public $css = [
        'settings.css'
    ];

    public $depends = [
        CpAsset::class
    ];
}