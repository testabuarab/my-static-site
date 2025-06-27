<?php
namespace Ryssbowh\BootstrapTheme\bundles;

use craft\web\AssetBundle;

class FrontJsAssets extends AssetBundle
{
    public $sourcePath = __DIR__ . '/../assets/src/js';

    public $js = [
        'bootstrap.js'
    ];
}