<?php
namespace abmat\tinymce\assets\field;

use Craft;
use craft\helpers\FileHelper;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use craft\web\View;
use abmat\tinymce\assets\tinymce\TinymceAsset;
use abmat\tinymce\assets\field\CustomAsset;

/**
 * TinyMCE field asset bundle
 */
class FieldAsset extends AssetBundle
{
     /**
     * @inheritdoc
     */
    public $depends = [
        CpAsset::class,
        CustomAsset::class,
        TinymceAsset::class,
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/tinymceField.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/utils.js',
        'js/tinymceInput.js',
        'js/craftLink.js',
        'js/craftImage.js',
        'js/langs/de.js',
    ];
    
    public static function getSourcePath() {
    	return __DIR__ . '/dist';
    }
    
    public function init()
    {
    	$this->sourcePath = self::getSourcePath();
    	
    	parent::init();
    }
}
