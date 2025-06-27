<?php

namespace abmat\tinymce\assets\tinymce;

use Craft;
use craft\helpers\Json;
use craft\web\View;
use craft\web\AssetBundle;

/**
 * TinyMCE asset bundle.
 *
 * @author abm
 * @since 1.0
 */
class TinymceAsset extends AssetBundle
{
    public static function getSourcePath() {
		  return Craft::$app->getPath()->getVendorPath()."/tinymce/tinymce";
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = self::getSourcePath();
        $this->js = ['tinymce.min.js'];
        
        parent::init();
    }
    
    /**
     * Register the custom translations for the Redactor field.
     *
     * @param View $view
     */
    public static function registerTranslations(View $view): void
    {
    	$customTranslations = [
    			'image_insertEditImage' => Craft::t('abm-tinymce', 'Insert / Edit image'),
    			"image_editImage" => Craft::t('abm-tinymce', "Edit Image"),
    			'image_alternateText' => Craft::t('abm-tinymce', 'Alternate text'),
    			"image_title" => Craft::t('abm-tinymce', 'Title'),
    			"image_class" => Craft::t('abm-tinymce', 'Image Class'),
    			"image_width" => Craft::t('abm-tinymce', 'Width'),
    			"image_height" => Craft::t('abm-tinymce', 'Height'),
    			"image_loading" => Craft::t('abm-tinymce', 'Loading Attribute'),
    			"image_transform" => Craft::t('abm-tinymce', 'Transform'),
    			
    			"link_insertEditLink" => Craft::t('abm-tinymce', 'Insert / Edit Link'),
    			"link_targetLabel" => Craft::t('abm-tinymce', 'Open Link in ...'),
    			"link_class" => Craft::t('abm-tinymce', 'Link Class'),
    			"link_site" => Craft::t('abm-tinymce', 'Site'),
    			"linkLabel" => Craft::t('abm-tinymce', 'Link'),
    			"link_additionalClasses" => Craft::t('abm-tinymce', 'Additional Classes'),
    	];
    	
    	$view->registerJs('
			if(typeof translations === "undefined") {translations = new Object();}
			translations.tinymce = '.Json::encode($customTranslations).';
		');
    }
}
