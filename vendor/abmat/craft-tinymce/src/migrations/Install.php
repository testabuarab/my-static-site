<?php
namespace abmat\tinymce\migrations;

use Craft;
use craft\db\Migration;
use craft\helpers\FileHelper;
use craft\helpers\Json;

/**
 * Install migration.
 */
class Install extends Migration {

	/**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
		$config_path = $this->getPath();

		if(!is_dir($config_path)) {
			$this->saveDefaultConfig();
			$this->saveDefaultCss();
		}
		return true;
	}

	/**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
		echo 'remove the directory "tinymce" in '.Craft::getAlias('@config')."\n";
        return true;
    }
	
	public function getPath() {
		return Craft::$app->getPath()->getConfigPath() . DIRECTORY_SEPARATOR . 'tinymce';
	}

	public function saveDefaultConfig() {
		$filepath = $this->getPath() . DIRECTORY_SEPARATOR . "Default.json";
        $json = Json::encode($this->generateDefault(), JSON_PRETTY_PRINT) . "\n";

		FileHelper::writeToFile($filepath, $json);
	}

	public function saveDefaultCss() {
		$filepath = $this->getPath() . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "Default.css";

		FileHelper::writeToFile($filepath, "/*"."\n".
			"file would be used in option content_css"."\n".
			"write you custom css code here"."\n".
			"*/"
		);
	}

	public function generateDefault() {
		return [
			'branding' => false,
			'menubar' => false,
			'contextmenu' => false,
			'extended_valid_elements' => "img[src|alt|title|width|height|class|loading],+@[data-options]",
			'forced_root_block' => 'p',
			'relative_urls' => false,
			'remove_script_host' => false,
			'convert_urls' => false,
			'paste_as_text' => true,
			'plugins' => 'autoresize code table anchor link lists craftlink craftimage',
			'toolbar'=> [
				implode(' | ',[
					'styles',
					'bold italic underline',
					'alignleft aligncenter alignright alignjustify',
					'bullist numlist'
				]),
				implode(' | ',[
					'code',
					'craftimage',
					'craftlink unlink anchor'
				])
			],
			'craftlink_adv_tab' => false,
			'craftlink_data_attr' => [],
			'craftlink_anker' => true,
			'link_class_list' => [
				[
					'title'=>'None',
					'value'=>''
				]
			],
			'object_resizing' => false,
			'craftimage_title' => true,
			'craftimage_class_list' => [
				[
					'title'=>'Default',
					'value'=>'editor-img-default',
				]
			],
			'style_formats' => [
				[
					'title' => 'SEO',
					'items' => [
						[
							'title'=>'H1',
							'format'=>'h1',
						],
						[
							'title'=>'H2',
							'format'=>'h2',
						],
						[
							'title'=>'H3',
							'format'=>'h3',
						],
						[
							'title'=>'H4',
							'format'=>'h4',
						],
						[
							'title'=>'H5',
							'format'=>'h5',
						],
						[
							'title'=>'H6',
							'format'=>'h6',
						]
					]
				]
			]
		];
	}
}