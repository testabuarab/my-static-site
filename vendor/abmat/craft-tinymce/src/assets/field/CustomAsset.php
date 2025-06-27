<?php
namespace abmat\tinymce\assets\field;

use Craft;
use craft\helpers\FileHelper;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use craft\web\View;

/**
 * TinyMCE field asset bundle
 */
class CustomAsset extends AssetBundle
{
	/**
	* @inheritdoc
	*/
   public $depends = [
	   CpAsset::class,
   ];

    public function init()
    {
        $sourcePath = Craft::getAlias('@config/tinymce/resources');
        if (!is_dir($sourcePath)) {
            return;
        }

		$this->sourcePath = $sourcePath;

		foreach (FileHelper::findFiles($this->sourcePath, ['only' => ['*.css']]) as $file) {
            $relativePath = substr($file, strlen($this->sourcePath) + 1);
            switch (pathinfo($file, PATHINFO_EXTENSION)) {
                case 'js':
                    $this->js[] = $relativePath;
                    break;
                case 'css':
                    $this->css[] = $relativePath;
                    break;
            }
        }

        parent::init();
    }
}
