<?php
namespace Ryssbowh\BootstrapTheme;

use Ryssbowh\BootstrapTheme\ThemePreferences;
use Ryssbowh\BootstrapTheme\bundles\BootstrapJsAssets;
use Ryssbowh\BootstrapTheme\bundles\CpAssets;
use Ryssbowh\BootstrapTheme\bundles\FrontCssAssets;
use Ryssbowh\BootstrapTheme\bundles\FrontJsAssets;
use Ryssbowh\BootstrapTheme\models\Settings;
use Ryssbowh\BootstrapTheme\models\blockProviders\BootstrapBlockProvider;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\AssetAccordion;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\AssetCard;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\AssetCarousel;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\AssetListGroup;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\CategoryAccordion;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\CategoryCard;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\CategoryListGroup;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\EntryAccordion;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\EntryCard;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\EntryListGroup;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\MatrixAccordion;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\MatrixCard;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\MatrixListGroup;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\TagBadge;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\TagListGroup;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\UrlButton;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\UserAccordion;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\UserCard;
use Ryssbowh\BootstrapTheme\models\fieldDisplayers\UserListGroup;
use Ryssbowh\CraftThemes\Themes;
use Ryssbowh\CraftThemes\base\ThemePlugin;
use Ryssbowh\CraftThemes\controllers\CpBlocksController;
use Ryssbowh\CraftThemes\controllers\CpDisplayController;
use Ryssbowh\CraftThemes\events\DefinableOptionsDefinitions;
use Ryssbowh\CraftThemes\events\RegisterBlockProviders;
use Ryssbowh\CraftThemes\events\RegisterBundles;
use Ryssbowh\CraftThemes\events\RegisterFieldDefaultDisplayerEvent;
use Ryssbowh\CraftThemes\events\RegisterFieldDisplayerEvent;
use Ryssbowh\CraftThemes\interfaces\ThemePreferencesInterface;
use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\AssetLinkOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\ElementLinkOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\ElementLinksOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\EmailEmailOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\TagLabelOptions;
use Ryssbowh\CraftThemes\models\fieldDisplayerOptions\UrlLinkOptions;
use Ryssbowh\CraftThemes\models\fields\ElementUrl;
use Ryssbowh\CraftThemes\models\fileDisplayerOptions\LinkOptions;
use Ryssbowh\CraftThemes\scss\Compiler;
use Ryssbowh\CraftThemes\services\BlockProvidersService;
use Ryssbowh\CraftThemes\services\FieldDisplayerService;
use craft\base\Model;
use craft\web\View;
use yii\base\Event;

class Theme extends ThemePlugin
{
    /**
     * @var Theme
     */
    public static $plugin;

    /**
     * @inheritDoc
     */
    public bool $hasCpSettings = true;

    /**
     * @inheritDoc
     */
    protected $assetBundles = [
        '*' => [
            BootstrapJsAssets::class,
            FrontCssAssets::class,
            // WebpackFrontAssets::class,
            FrontJsAssets::class,
        ]
    ];

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        parent::init();
        $this::$plugin = $this;
        $this->registerDisplayers();
        $this->modifyDisplayers();
        $this->registerBlockProviders();

        if (\Craft::$app->request->isCpRequest) {
            $this->registerCpBundles();
        }

        if (\Craft::$app->request->isSiteRequest) {
            $this->settings->registerFont();
        }
    }

    /**
     * @inheritDoc
     */
    public function getTemplatesFolder(): string
    {
        return 'templates/front';
    }

    /**
     * @inheritDoc
     */
    public function afterSaveSettings(): void
    {
        parent::afterSaveSettings();
        $this->settings->writeScssResourceFile();
        if ($this->settings->rebuildScssOnSettings) {
            $compiler = $this->scssCompiler;
            $compiler->compile([
                $this->settings->scssEntryPoint => 'app.css'
            ], $this->basePath);
        }
    }

    /**
     * @inheritdoc
     */
    public function getSettingsResponse(): mixed
    {
        $controller = \Craft::$app->controller;

        return $controller->renderTemplate('bootstrap-theme/cp/settings', [
            'plugin' => $this,
            'mainFormAttributes' => [
                'enctype' => "multipart/form-data",
                'autocomplete' => 'off'
            ],
            'settings' => $this->settings,
            'plugin' => $this
        ]);
    }

    /**
     * @inheritDoc
     */
    public function afterThemeInstall()
    {
        $this->settings->writeScssResourceFile(true);
        $defaultLayout = Themes::$plugin->layouts->getDefault('bootstrap-theme');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'system',
            'handle' => 'content'
        ]);
        $defaultLayout->addBlock($block, 'content');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'system',
            'handle' => 'flash-messages'
        ]);
        $defaultLayout->addBlock($block, 'before-content');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'system',
            'handle' => 'sitename'
        ]);
        $defaultLayout->addBlock($block, 'header-left');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'bootstrap',
            'handle' => 'powered-by'
        ]);
        $defaultLayout->addBlock($block, 'footer-right');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'bootstrap',
            'handle' => 'main-menu'
        ]);
        $defaultLayout->addBlock($block, 'header-middle');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'forms',
            'handle' => 'search'
        ]);
        $defaultLayout->addBlock($block, 'header-right');
        $block = Themes::$plugin->blocks->create([
            'provider' => 'bootstrap',
            'handle' => 'footer-menu'
        ]);
        $defaultLayout->addBlock($block, 'footer-left');
        Themes::$plugin->layouts->save($defaultLayout);
        Themes::$plugin->layouts->copyIntoCustom($defaultLayout, '404', '404');
        Themes::$plugin->layouts->copyIntoCustom($defaultLayout, '500', '500');
        Themes::$plugin->layouts->copyIntoCustom($defaultLayout, '503', '503');
    }

    /**
     * Register a bundle on cp requests
     */
    protected function registerCpBundles()
    {
        Event::on(CpDisplayController::class, CpDisplayController::EVENT_REGISTER_ASSET_BUNDLES, function (RegisterBundles $event) {
            $event->bundles[] = CpAssets::class;
        });
    }

    /**
     * Register new block provider
     */
    protected function registerBlockProviders()
    {
        Event::on(BlockProvidersService::class, BlockProvidersService::EVENT_REGISTER_BLOCK_PROVIDERS, function (RegisterBlockProviders $event) {
            $event->add(new BootstrapBlockProvider);
        });
    }

    /**
     * Register new displayers
     */
    protected function registerDisplayers()
    {
        Event::on(FieldDisplayerService::class, FieldDisplayerService::EVENT_REGISTER_DISPLAYERS, function (RegisterFieldDisplayerEvent $event) {
            $event->registerMany([
                AssetCarousel::class,
                MatrixAccordion::class,
                EntryAccordion::class,
                UserAccordion::class,
                AssetAccordion::class,
                CategoryAccordion::class,
                AssetCard::class,
                CategoryCard::class,
                EntryCard::class,
                UserCard::class,
                MatrixCard::class,
                AssetListGroup::class,
                CategoryListGroup::class,
                EntryListGroup::class,
                UserListGroup::class,
                TagListGroup::class,
                MatrixListGroup::class,
            ]);
        });
    }

    /**
     * Change some displayers options definitions
     */
    protected function modifyDisplayers()
    {
        $_this = $this;
        Event::on(ElementLinkOptions::class, ElementLinkOptions::EVENT_OPTIONS_DEFINITIONS, function (DefinableOptionsDefinitions $e) use ($_this) {
            $_this->addButtonOptions($e);
        });
        Event::on(EmailEmailOptions::class, EmailEmailOptions::EVENT_OPTIONS_DEFINITIONS, function (DefinableOptionsDefinitions $e) use ($_this) {
            $_this->addButtonOptions($e);
        });
        Event::on(UrlLinkOptions::class, UrlLinkOptions::EVENT_OPTIONS_DEFINITIONS, function (DefinableOptionsDefinitions $e) use ($_this) {
            $_this->addButtonOptions($e);
        });
        Event::on(ElementLinksOptions::class, ElementLinksOptions::EVENT_OPTIONS_DEFINITIONS, function (DefinableOptionsDefinitions $e) use ($_this) {
            $_this->addButtonOptions($e);
        });
        Event::on(LinkOptions::class, LinkOptions::EVENT_OPTIONS_DEFINITIONS, function (DefinableOptionsDefinitions $e) use ($_this) {
            $_this->addButtonOptions($e);
        });
        Event::on(TagLabelOptions::class, TagLabelOptions::EVENT_OPTIONS_DEFINITIONS, function (DefinableOptionsDefinitions $e) use ($_this) {
            $_this->addBadgeOptions($e);
        });
    }

    /**
     * Add bagde options to a Definable options event
     */
    protected function addBadgeOptions(Event $e)
    {
        $e->definitions['displayAsBadge'] = [
            'field' => 'lightswitch',
            'label' => \Craft::t('bootstrap-theme', 'Display as badge')
        ];
        $e->definitions['bg-color'] = [
            'field' => 'select',
            'options' => [
                'primary' => \Craft::t('bootstrap-theme', 'Primary'),
                'secondary' => \Craft::t('bootstrap-theme', 'Secondary'),
                'success' => \Craft::t('bootstrap-theme', 'Success'),
                'danger' => \Craft::t('bootstrap-theme', 'Danger'),
                'warning' => \Craft::t('bootstrap-theme', 'Warning'),
                'info' => \Craft::t('bootstrap-theme', 'Info'),
                'light' => \Craft::t('bootstrap-theme', 'Light'),
                'dark' => \Craft::t('bootstrap-theme', 'Dark'),
            ],
            'label' => \Craft::t('bootstrap-theme', 'Badge background color')
        ];
        $e->definitions['pill'] = [
            'field' => 'lightswitch',
            'label' => \Craft::t('bootstrap-theme', 'Pill badge'),
            'instructions' => \Craft::t('bootstrap-theme', 'More rounded badge')
        ];
        $e->defaultValues['displayAsBadge'] = true;
        $e->defaultValues['bg-color'] = 'primary';
        $e->defaultValues['pill'] = false;
    }

    /**
     * Add button options to a Definable options event
     */
    protected function addButtonOptions(Event $e)
    {
        $e->definitions['color'] = [
            'field' => 'select',
            'options' => [
                'primary' => \Craft::t('bootstrap-theme', 'Primary'),
                'secondary' => \Craft::t('bootstrap-theme', 'Secondary'),
                'success' => \Craft::t('bootstrap-theme', 'Success'),
                'danger' => \Craft::t('bootstrap-theme', 'Danger'),
                'warning' => \Craft::t('bootstrap-theme', 'Warning'),
                'info' => \Craft::t('bootstrap-theme', 'Info'),
                'light' => \Craft::t('bootstrap-theme', 'Light'),
                'dark' => \Craft::t('bootstrap-theme', 'Dark'),
            ],
            'label' => \Craft::t('bootstrap-theme', 'Color')
        ];
        $e->definitions['displayAsButton'] = [
            'field' => 'lightswitch',
            'label' => \Craft::t('bootstrap-theme', 'Display as button')
        ];
        $e->definitions['outlined'] = [
            'field' => 'lightswitch',
            'label' => \Craft::t('bootstrap-theme', 'Outlined button')
        ];
        $e->definitions['size'] = [
            'field' => 'select',
            'options' => [
                'normal' => \Craft::t('bootstrap-theme', 'Normal'),
                'lg' => \Craft::t('bootstrap-theme', 'Large'),
                'sm' => \Craft::t('bootstrap-theme', 'Small')
            ],
            'label' => \Craft::t('bootstrap-theme', 'Button size')
        ];
        $e->defaultValues['displayAsButton'] = true;
        $e->defaultValues['color'] = 'primary';
        $e->defaultValues['outlined'] = false;
        $e->defaultValues['size'] = 'normal';
    }

    /**
     * @inheritDoc
     */
    protected function getPreviewImagePath(): ?string
    {
        return realpath($this->basePath . "/assets/images/preview.png");
    }

    /**
     * @inheritDoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings;
    }

    /**
     * @inheritDoc
     */
    /*protected function defineRegions(): ?array
    {
        return [
            [
                'handle' => 'before-header',
                'name' => \Craft::t('bootstrap-theme', 'Before Header'),
                'width' => '100%',
            ],
            [
                'handle' => 'header-left',
                'name' => \Craft::t('bootstrap-theme', 'Header Left'),
                'width' => '32%',
            ],
            [
                'handle' => 'header-middle',
                'name' => \Craft::t('bootstrap-theme', 'Header Middle'),
                'width' => '32%',
            ],
            [
                'handle' => 'header-right',
                'name' => \Craft::t('bootstrap-theme', 'Header Right'),
                'width' => '32%',
            ],
            [
                'handle' => 'after-header',
                'name' => \Craft::t('bootstrap-theme', 'After Header'),
                'width' => '100%',
            ],
            [
                'handle' => 'banner',
                'name' => \Craft::t('bootstrap-theme', 'Banner'),
                'width' => '100%',
            ],
            [
                'handle' => 'before-content',
                'name' => \Craft::t('bootstrap-theme', 'Before Content'),
                'width' => '100%',
            ],
            [
                'handle' => 'sidebar',
                'name' => \Craft::t('bootstrap-theme', 'Sidebar'),
                'width' => '32%',
            ],
            [
                'handle' => 'content',
                'name' => \Craft::t('bootstrap-theme', 'Content'),
                'width' => '66%',
            ],
            [
                'handle' => 'after-content',
                'name' => \Craft::t('bootstrap-theme', 'After Content'),
                'width' => '100%',
            ],
            [
                'handle' => 'before-footer',
                'name' => \Craft::t('bootstrap-theme', 'Before Footer'),
                'width' => '100%',
            ],
            [
                'handle' => 'footer-left',
                'name' => \Craft::t('bootstrap-theme', 'Footer Left'),
                'width' => '32%',
            ],
            [
                'handle' => 'footer-middle',
                'name' => \Craft::t('bootstrap-theme', 'Footer Middle'),
                'width' => '32%',
            ],
            [
                'handle' => 'footer-right',
                'name' => \Craft::t('bootstrap-theme', 'Footer Right'),
                'width' => '32%',
            ],
            [
                'handle' => 'after-footer',
                'name' => \Craft::t('bootstrap-theme', 'After Footer'),
                'width' => '100%',
            ],
        ];
    }*/

    /**
     * @inheritDoc
     */
    protected function getPreferencesModel(): ThemePreferencesInterface
    {
        return new ThemePreferences;
    }
}