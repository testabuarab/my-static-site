<?php
namespace Ryssbowh\BootstrapTheme\bundles;

use craft\web\AssetBundle;

class BootstrapJsAssets extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = '@Ryssbowh/BootstrapTheme/node_modules/bootstrap/dist/js';

    /**
     * @inheritDoc
     */
    public $js = [
        'bootstrap.bundle.min.js'
    ];
}