<?php
namespace abmat\tinymce;

use Craft;
use craft\base\ElementInterface;
use craft\elements\Asset;
use craft\elements\Category;
use craft\elements\Entry;
use craft\helpers\FileHelper;
use craft\helpers\HtmlPurifier;
use craft\helpers\ArrayHelper;
use craft\helpers\Db;
use craft\helpers\Html;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use craft\helpers\Template;
use craft\htmlfield\HtmlField;
use craft\htmlfield\HtmlFieldData;
use craft\htmlfield\events\ModifyPurifierConfigEvent;
use craft\fields\conditions\TextFieldConditionRule;
use craft\models\Section;
use craft\commerce\elements\Product;
use craft\commerce\elements\Variant;
use craft\commerce\Plugin as CommercePlugin;
use abmat\tinymce\assets\field\FieldAsset;
use abmat\tinymce\assets\tinymce\TinymceAsset;
use yii\base\Event;
use yii\db\Schema;
use HTMLPurifier_Config;

/**
 * TinyMCE field type.
 *
 * @author ABM Feregyhazy & Simon GmbH
 * @since 1.0
 */
class Field extends HtmlField
{

    /**
     * @var string|null The Tinymce config file to use
     */
    public ?string $tinymceConfig = null;

    /**
     * @var string|array|null The volumes that should be available for Image selection.
     */
    public $availableVolumes = '*';

    /**
     * @var string|array|null The transforms available when selecting an image
     */
    public $availableTransforms = '*';

    /**
     * @var bool Whether "view source" button should only be displayed to admins.
     * @since 2.7.0
     */
    public bool $showHtmlButtonForNonAdmins = false;


    /**
     * @var bool Whether to show input sources for volumes the user doesn’t have permission to view.
     * @since 2.6.0
     */
    public bool $showUnpermittedVolumes = false;

    /**
     * @var bool Whether to show files the user doesn’t have permission to view, per the
     * “View files uploaded by other users” permission.
     * @since 2.6.0
     */
    public bool $showUnpermittedFiles = false;

    /**
     * @event ModifyPurifierConfigEvent The event that is triggered when creating HTML Purifier config
     *
     * Plugins can get notified when HTML Purifier config is being constructed.
     *
     * ```php
     * use craft\redactor\Field;
     * use craft\htmlfield\ModifyPurifierConfigEvent;
     * use HTMLPurifier_AttrDef_Text;
     * use yii\base\Event;
     *
     * Event::on(
     *     Field::class,
     *     Field::EVENT_MODIFY_PURIFIER_CONFIG,
     *     function(ModifyPurifierConfigEvent $event) {
     *          // ...
     *     }
     * );
     * ```
     */
    public const EVENT_MODIFY_PURIFIER_CONFIG = 'modifyPurifierConfig';

    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('abm-tinymce', 'TinyMCE');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct(array $config = [])
    {
        // Default showHtmlButtonForNonAdmins to true for existing Assets fields
        if (isset($config['id']) && !isset($config['showHtmlButtonForNonAdmins'])) {
            $config['showHtmlButtonForNonAdmins'] = true;
        }

        // normalize a mix/match of ids and uids to a list of uids.
        if (isset($config['availableVolumes']) && is_array($config['availableVolumes'])) {
            $ids = [];
            $uids = [];

            foreach ($config['availableVolumes'] as $availableVolume) {
                if (is_int($availableVolume)) {
                    $ids[] = $availableVolume;
                } else {
                    $uids[] = $availableVolume;
                }
            }

            if (!empty($ids)) {
                $uids = array_merge($uids, Db::uidsByIds('{{%volumes}}', $ids));
            }

            $config['availableVolumes'] = $uids;
        }

        // normalize a mix/match of ids and uids to a list of uids.
        if (isset($config['availableTransforms']) && is_array($config['availableTransforms'])) {
            $ids = [];
            $uids = [];

            foreach ($config['availableTransforms'] as $availableTransform) {
                if (is_int($availableTransform)) {
                    $ids[] = $availableTransform;
                } else {
                    $uids[] = $availableTransform;
                }
            }

            if (!empty($ids)) {
                $uids = array_merge($uids, Db::uidsByIds('{{%assettransforms}}', $ids));
            }

            $config['availableTransforms'] = $uids;
        }

        // Default showUnpermittedVolumes to true for existing TinyMCE fields
        if (isset($config['id']) && !isset($config['showUnpermittedVolumes'])) {
            $config['showUnpermittedVolumes'] = true;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
    {
        $volumeOptions = [];
        foreach (Craft::$app->getVolumes()->getAllVolumes() as $volume) {
            if ($volume->getFs()->hasUrls) {
                $volumeOptions[] = [
                    'label' => $volume->name,
                    'value' => $volume->uid,
                ];
            }
        }

        $transformOptions = [];
        foreach (Craft::$app->getImageTransforms()->getAllTransforms() as $transform) {
            $transformOptions[] = [
                'label' => $transform->name,
                'value' => $transform->uid,
            ];
        }

        return Craft::$app->getView()->renderTemplate('abm-tinymce/_field_settings', [
            'field' => $this,
            'purifierConfigOptions' => $this->_getCustomConfigOptions('htmlpurifier'),
            'tinymceConfigOptions' => $this->_getCustomConfigOptions('tinymce'),
            'volumeOptions' => $volumeOptions,
            'transformOptions' => $transformOptions
        ]);
    }

    /**
     * @inheritdoc
     */
    public function serializeValue(mixed $value, ?\craft\base\ElementInterface $element = null): mixed
    {
        if ($value instanceof HtmlFieldData) {
            $value = $value->getRawContent();
        }

        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    protected function inputHtml(mixed $value, ElementInterface $element = null): string
    {

        $view = Craft::$app->getView();
        $view->registerAssetBundle(FieldAsset::class);

        $id = Html::id($this->handle);
        $sitesService = Craft::$app->getSites();
        $elementSite = ($element ? $element->getSite() : $sitesService->getCurrentSite());

        $defaultTransform = '';

        $volumes = $this->_getVolumeKeys();

        $allSites = [];
        foreach ($sitesService->getAllSites(false) as $site) {
            $allSites[$site->id] = $site->name;
        }

        $base_url = \Craft::$app->assetManager->getPublishedUrl(TinymceAsset::getSourcePath(),false);
        $themeUrl =  $base_url . '/themes/silver/theme.js';
        $customerCssUrl = \Craft::$app->assetManager->getPublishedUrl(Craft::getAlias('@config/tinymce/resources')."/".str_replace(".json",".css",$this->tinymceConfig),false);

        $config = $this->_getTinymceConfig();

        if(count($volumes)===0) {
            $plugins = explode(" ",$config["plugins"]);
            $plugins = array_diff($plugins,Array("craftimage"));
            $config["plugins"] = implode(" ",$plugins);

            if(is_array($config["toolbar"])) {
                foreach($config["toolbar"] as $i=>$toolbar) {
                    $buttons = explode(" ",$toolbar);
                    $buttons = array_diff($buttons,Array("craftimage"));
                    $config["toolbar"][$i] = str_replace(Array("| |","||"),"|",implode(" ",$buttons));
                }
            }
        }

        if (!$this->showHtmlButtonForNonAdmins && !Craft::$app->getUser()->getIsAdmin()) {
            $plugins = explode(" ",$config["plugins"]);
            $plugins = array_diff($plugins,Array("code"));
            $config["plugins"] = implode(" ",$plugins);

            if(is_array($config["toolbar"])) {
                foreach($config["toolbar"] as $i=>$toolbar) {
                    $buttons = explode(" ",$toolbar);
                    $buttons = array_diff($buttons,Array("code"));
                    $config["toolbar"][$i] = str_replace(Array("| |","||"),"|",implode(" ",$buttons));
                }
            }
        }
        
        $tinymceInitObject = array_merge(
            [
                'autoresize_bottom_margin' => 20,
                'autoresize_max_height' => 500,

                'craftlink_adv_tab' => false,
                'craftlink_data_attr' => [],
                'craftlink_anker' => false,

                'craftimage_class_list' => [],
                'craftimage_title' => false,
            ],
            $config,
            [
                'theme_url' => $themeUrl,
                'base_url' => $base_url,
            ]
        );

        if($customerCssUrl!==false) {
            $tinymceInitObject = array_merge(
                $tinymceInitObject,
                [
                    "content_css" => $customerCssUrl
                ]
            );
        }

        $settings = [
            'id' => $view->namespaceInputId($id),
            'linkOptions' => $this->_getLinkOptions($element),
            'volumes' => $volumes,
            'transforms' => $this->_getTransforms(),
            'defaultTransform' => $defaultTransform,
            'elementSiteId' => $elementSite,
            'allSites' => $allSites,
            'tinymceConfig' => $tinymceInitObject,
            'showAllUploaders' => $this->showUnpermittedFiles,
        ];
        
        TinymceAsset::registerTranslations($view);
        $view->registerJs('new Craft.TinymceInput(' . Json::encode($settings) . ');');
        
        $value = $this->prepValueForInput($value, $element);

        return implode('', [
            '<textarea id="' . $id . '" name="' . $this->handle . '" class="tinymce" style="visibility: hidden; position: fixed; top: -9999px">',
                htmlentities($value, ENT_NOQUOTES, 'UTF-8'),
            '</textarea>',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getStaticHtml($value, ElementInterface $element): string
    {
        return
            Html::beginTag('div', [
                'class' => array_filter([
                    'text'
                ]),
            ]) .
            ($this->prepValueForInput($value, $element) ?: '&nbsp;') .
            Html::endTag('div');
    }

    // Private Methods
    // =========================================================================

    /**
     * Returns the available Redactor config options.
     *
     * @param string $dir The directory name within the config/ folder to look for config files
     * @return array
     */
    private function _getCustomConfigOptions(string $dir): array
    {
        $options = [];
        $path = Craft::$app->getPath()->getConfigPath().DIRECTORY_SEPARATOR.$dir;

        if (is_dir($path)) {
            $files = FileHelper::findFiles($path, [
                'only' => ['*.json'],
                'recursive' => false
            ]);

            foreach ($files as $file) {
                $options[pathinfo($file, PATHINFO_BASENAME)] = pathinfo($file, PATHINFO_FILENAME);
            }
        }

        return $options;
    }

    /**
     * Returns the HTML Purifier config used by this field.
     *
     * @return array
     */
    private function _getPurifierConfig(): array
    {
        if ($config = $this->_getConfig('htmlpurifier', $this->purifierConfig)) {
            return $config;
        }

        // Default config
        return [
            'Attr.AllowedFrameTargets' => ['_blank'],
            'HTML.AllowedComments' => ['pagebreak'],
        ];
    }

    /**
     * Returns the TinyMCE config used by this field.
     *
     * @return array
     */
    private function _getTinymceConfig(): array
    {
        $config = $this->config('tinymce', $this->tinymceConfig) ?: [];
        
        $languages = array_unique([Craft::$app->language, Craft::$app->getLocale()->getLanguageID()]);
        
        foreach($languages as $lang) {
        	
        	$tinymce_lang = $lang;

            if($lang === "de" || preg_match("/^de-/",$lang)) {
        		$tinymce_lang = "de";
        		
        	} elseif($lang === "fr" || preg_match("/^fr-/",$lang)) {
        		$tinymce_lang = "fr_FR";

            } elseif($lang === "it" || preg_match("/^it-/",$lang)) {
        		$tinymce_lang = "it";

            } elseif($lang === "es" || preg_match("/^es-/",$lang)) {
        		$tinymce_lang = "es";
        		
        	}
        	
        	$language_file = FieldAsset::getSourcePath() . '/js/langs/'.$tinymce_lang.'.js';
        	
        	if(is_file($language_file)) {
        		$language_js_url = \Craft::$app->assetManager->getPublishedUrl($language_file,true);
        		if($language_js_url!="") {
	        		$config["language"] = $tinymce_lang;
	        		$config["language_url"] = $language_js_url;
	        		break;
	        	}
        	}
        }
        
        return $config;
    }

    /**
     * @inheritdoc
     */
    protected function defaultPurifierOptions(): array
    {
        $options = parent::defaultPurifierOptions();
        $options['HTML.AllowedComments'] = ['pagebreak'];
        return $options;
    }
    
    /**
     * @inheritdoc
     */
    protected function createFieldData(string $content, ?int $siteId): HtmlFieldData
    {
        return new HtmlFieldData($content, $siteId);
    }

    /**
     * Returns the available section sources.
     *
     * @param ElementInterface|null $element The element the field is associated with, if there is one
     * @return array
     */
    private function _getSectionSources(ElementInterface $element = null): array
    {
        $sources = [];
        $sections = Craft::$app->getSections()->getAllSections();
        $showSingles = false;

        // Get all sites
        $sites = Craft::$app->getSites()->getAllSites();

        foreach ($sections as $section) {
            if ($section->type === Section::TYPE_SINGLE) {
                $showSingles = true;
            } elseif ($element) {
                $sectionSiteSettings = $section->getSiteSettings();
                foreach ($sites as $site) {
                    if (isset($sectionSiteSettings[$site->id]) && $sectionSiteSettings[$site->id]->hasUrls) {
                        $sources[] = 'section:' . $section->uid;
                    }
                }
            }
        }

        if ($showSingles) {
            array_unshift($sources, 'singles');
        }

        if (!empty($sources)) {
            array_unshift($sources, '*');
        }

        return $sources;
    }

    /**
     * Returns the link options available to the field.
     * Each link option is represented by an array with the following keys:
     * - `optionTitle` (required) – the user-facing option title that appears in the Link dropdown menu
     * - `elementType` (required) – the element type class that the option should be linking to
     * - `sources` (optional) – the sources that the user should be able to select elements from
     * - `criteria` (optional) – any specific element criteria parameters that should limit which elements the user can select
     * - `storageKey` (optional) – the localStorage key that should be used to store the element selector modal state (defaults to RedactorInput.LinkTo[ElementType])
     *
     * @param ElementInterface|null $element The element the field is associated with, if there is one
     * @return array
     */
    private function _getLinkOptions(ElementInterface $element = null): array
    {
        $pluginsService = Craft::$app->getPlugins();
        $linkOptions = [];

        $sectionSources = $this->_getSectionSources($element);
        $categorySources = $this->_getCategorySources($element);

        if (!empty($sectionSources)) {
            $linkOptions[] = [
                'optionTitle' => Craft::t('abm-tinymce', 'Link to an entry'),
                'elementType' => Entry::class,
                'refHandle' => Entry::refHandle(),
                'sources' => $sectionSources,
                'criteria' => ['uri' => ':notempty:'],
            ];
        }

        if (!empty($this->_getVolumeKeys())) {
            $linkOptions[] = [
                'optionTitle' => Craft::t('abm-tinymce', 'Link to an asset'),
                'elementType' => Asset::class,
                'refHandle' => Asset::refHandle(),
                'sources' => $this->_getVolumeKeys(),
            ];
        }

        if (!empty($categorySources)) {
            $linkOptions[] = [
                'optionTitle' => Craft::t('abm-tinymce', 'Link to a category'),
                'elementType' => Category::class,
                'refHandle' => Category::refHandle(),
                'sources' => $categorySources,
            ];
        }

        if ($pluginsService->isPluginInstalled('commerce') && $pluginsService->isPluginEnabled('commerce')) {
            $productSources = $this->_getProductSources($element);

            if (!empty($productSources)) {
                $linkOptions[] = [
                    'optionTitle' => Craft::t('commerce', 'Link to a product'),
                    'elementType' => Product::class,
                    'refHandle' => Product::refHandle(),
                    'sources' => $productSources,
                ];

                $plugin = Plugin::getInstance();
                $settings = $plugin->getSettings();

                if($settings->linkToVariants) {
                    $linkOptions[] = [
                        'optionTitle' => Craft::t('commerce', 'Link to a variant'),
                        'elementType' => Variant::class,
                        'refHandle' => Variant::refHandle(),
                        'sources' => $productSources,
                    ];
                }
            }
        }

        // Fill in any missing ref handles
        foreach ($linkOptions as &$linkOption) {
            if (!isset($linkOption['refHandle'])) {
                /** @var ElementInterface|string $class */
                $class = $linkOption['elementType'];
                $linkOption['refHandle'] = $class::refHandle() ?? $class;
            }
        }

        return $linkOptions;
    }

    private function _getProductSources(?ElementInterface $element = null): array
    {
        $sources = [];

        if ($element) {
            foreach (CommercePlugin::getInstance()->getProductTypes()->getAllProductTypes() as $type) {
                $siteSettings = $type->getSiteSettings();

                if (isset($siteSettings[$element->siteId]) && $siteSettings[$element->siteId]->hasUrls) {
                    $sources[] = "productType:" . $type->uid;
                }
            }
        }

        return $sources;
    }

    /**
     * Returns the available category sources.
     *
     * @param ElementInterface|null $element The element the field is associated with, if there is one
     * @return array
     */
    private function _getCategorySources(ElementInterface $element = null): array
    {
        $sources = [];

        if ($element) {
            $categoryGroups = Craft::$app->getCategories()->getAllGroups();

            foreach ($categoryGroups as $categoryGroup) {
                // Does the category group have URLs in the same site as the element we're editing?
                $categoryGroupSiteSettings = $categoryGroup->getSiteSettings();
                if (isset($categoryGroupSiteSettings[$element->siteId]) && $categoryGroupSiteSettings[$element->siteId]->hasUrls) {
                    $sources[] = 'group:' . $categoryGroup->uid;
                }
            }
        }

        return $sources;
    }

    /**
     * Returns the available volumes.
     *
     * @return string[]
     */
    private function _getVolumeKeys(): array
    {
        if (!$this->availableVolumes) {
            return [];
        }

        $criteria = ['parentId' => ':empty:'];

        $allVolumes = Craft::$app->getVolumes()->getAllVolumes();
        $allowedVolumes = [];
        $userService = Craft::$app->getUser();

        foreach ($allVolumes as $volume) {
            $allowedBySettings = $this->availableVolumes === '*' || (is_array($this->availableVolumes) && in_array($volume->uid, $this->availableVolumes));
            if ($allowedBySettings && ($this->showUnpermittedVolumes || $userService->checkPermission("viewAssets:$volume->uid"))) {
                $allowedVolumes[] = 'volume:' . $volume->uid;
            }
        }

        return $allowedVolumes;
    }

    /**
     * Get available transforms.
     *
     * @return array
     */
    private function _getTransforms(): array
    {
        if (!$this->availableTransforms) {
            return [];
        }

        $allTransforms = Craft::$app->getImageTransforms()->getAllTransforms();
        $transformList = [];

        foreach ($allTransforms as $transform) {
            if (!is_array($this->availableTransforms) || in_array($transform->uid, $this->availableTransforms, false)) {
                $transformList[] = [
                    'handle' => $transform->handle,
                    'name' => $transform->name,
                ];
            }
        }

        return $transformList;
    }


    /**
     * @inheritdoc
     */
    protected function purifierConfig(): HTMLPurifier_Config
    {
        $purifierConfig = parent::purifierConfig();

        if($def = $purifierConfig->getDefinition('HTML', true)) {
            $tinymceConfig = $this->_getTinymceConfig();
            if(array_key_exists("craftlink_data_attr",$tinymceConfig)) {
                foreach($tinymceConfig["craftlink_data_attr"] as $datakey) {
                    $def->addAttribute('a', 'data-'.$datakey, 'Text');
                }
            }
            $def->addAttribute('img', 'loading', 'Text');
        }

        // Give plugins a chance to modify the HTML Purifier config, or add new ones
        $event = new ModifyPurifierConfigEvent([
            'config' => $purifierConfig,
        ]);

        $this->trigger(self::EVENT_MODIFY_PURIFIER_CONFIG, $event);

        return $event->config;
    }

    /**
     * @inheritdoc
     */
    protected function searchKeywords(mixed $value, ElementInterface $element): string
    {
        $value = (string)$value;
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getElementConditionRuleType(): ?string
    {
        return TextFieldConditionRule::class;
    }
}