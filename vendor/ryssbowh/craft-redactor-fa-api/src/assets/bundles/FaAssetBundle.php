<?php

namespace Ryssbowh\RedactorFa\assets\bundles;

use craft\web\AssetBundle;
use craft\web\View;
use craft\web\assets\cp\CpAsset;

class FaAssetBundle extends AssetBundle
{
    public $sourcePath = '@Ryssbowh/RedactorFa/assets/dist';

    public $css = [
        'redactor.css'
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);

        if ($view instanceof View) {
            $this->_registerTranslations($view);
        }
    }

    protected function _registerTranslations($view)
    {
        $messages = require \Craft::getAlias('@Ryssbowh/RedactorFa/translations/en-GB/redactor-fa-api.php');
        $messages = array_keys($messages);
        $view->registerTranslations('redactor-fa-api', $messages);
    }
}