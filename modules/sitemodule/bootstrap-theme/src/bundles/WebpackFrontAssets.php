<?php
namespace Ryssbowh\BootstrapTheme\bundles;

use craft\web\AssetBundle;

/**
 * Bundle to use when using webpack compiling
 */
class WebpackFrontAssets extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = __DIR__ . '/../dist/app';

    /**
     * @inheritDoc
     */
    public $css = [
        'app.css'
    ];
}