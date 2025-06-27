<?php
namespace Ryssbowh\BootstrapTheme\events;

use Ryssbowh\BootstrapTheme\Theme;
use Ryssbowh\BootstrapTheme\exceptions\BootstrapSettingsException;
use Ryssbowh\BootstrapTheme\exceptions\BootstrapThemeException;
use Ryssbowh\BootstrapTheme\interfaces\BootstrapSettingsInterface;
use Ryssbowh\BootstrapTheme\models\settings\AccordionsSettings;
use Ryssbowh\BootstrapTheme\models\settings\AlertsSettings;
use Ryssbowh\BootstrapTheme\models\settings\BadgesSettings;
use Ryssbowh\BootstrapTheme\models\settings\BreadcrumbsSettings;
use Ryssbowh\BootstrapTheme\models\settings\ButtonsSettings;
use Ryssbowh\BootstrapTheme\models\settings\CardsSettings;
use Ryssbowh\BootstrapTheme\models\settings\CarouselsSettings;
use Ryssbowh\BootstrapTheme\models\settings\CloseSettings;
use Ryssbowh\BootstrapTheme\models\settings\ColorsSettings;
use Ryssbowh\BootstrapTheme\models\settings\DropdownsSettings;
use Ryssbowh\BootstrapTheme\models\settings\FormsSettings;
use Ryssbowh\BootstrapTheme\models\settings\ImagesSettings;
use Ryssbowh\BootstrapTheme\models\settings\ListsSettings;
use Ryssbowh\BootstrapTheme\models\settings\MiscSettings;
use Ryssbowh\BootstrapTheme\models\settings\ModalsSettings;
use Ryssbowh\BootstrapTheme\models\settings\NavsSettings;
use Ryssbowh\BootstrapTheme\models\settings\OffcanvasSettings;
use Ryssbowh\BootstrapTheme\models\settings\PaginationSettings;
use Ryssbowh\BootstrapTheme\models\settings\PopoversSettings;
use Ryssbowh\BootstrapTheme\models\settings\ProgressSettings;
use Ryssbowh\BootstrapTheme\models\settings\SpinnersSettings;
use Ryssbowh\BootstrapTheme\models\settings\TablesSettings;
use Ryssbowh\BootstrapTheme\models\settings\ToastsSettings;
use Ryssbowh\BootstrapTheme\models\settings\TooltipsSettings;
use Ryssbowh\BootstrapTheme\models\settings\TypographySettings;
use yii\base\Event;

class SettingsEvent extends Event
{
    /**
     * @var array
     */
    protected $_settings = [];

    /**
     * @var array
     */
    public $fonts = [
        'ubuntu' => [
            'fonts' => [
                'Roboto',
            ],
            'url' => 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'
        ],
        'roboto' => [
            'fonts' => [
                'Ubuntu'
            ],
            'url' => 'https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap'
        ]
    ];

    public function init()
    {
        parent::init();
        $this->addMany([
            new ColorsSettings,
            new MiscSettings,
            new TypographySettings,
            new TablesSettings,
            new ButtonsSettings,
            new FormsSettings,
            new NavsSettings,
            new DropdownsSettings,
            new PaginationSettings,
            new CardsSettings,
            new AccordionsSettings,
            new TooltipsSettings,
            new PopoversSettings,
            new ToastsSettings,
            new BadgesSettings,
            new ModalsSettings,
            new AlertsSettings,
            new ProgressSettings,
            new ListsSettings,
            new ImagesSettings,
            new BreadcrumbsSettings,
            new CarouselsSettings,
            new SpinnersSettings,
            new CloseSettings,
            new OffcanvasSettings
        ]);
    }

    /**
     * Add a bootstrap settings class
     * 
     * @param BootstrapSettingsInterface $settings
     */
    public function add(BootstrapSettingsInterface $settings)
    {
        if (isset($this->_settings[$settings->getHandle()])) {
            throw BootstrapSettingsException::settingsDefined($settings->getHandle());
        }
        $this->_settings[$settings->getHandle()] = $settings;
    }

    /**
     * Add many bootstrap settings class
     * 
     * @param array $settings
     */
    public function addMany(array $settings)
    {
        foreach ($settings as $setting) {
            $this->add($setting);
        }
    }

    /**
     * Get a bootstrap setting class by handle
     * 
     * @param  string $handle
     * @return ?BootstrapSettingsInterface
     */
    public function get(string $handle): ?BootstrapSettingsInterface
    {
        return $this->_settings[$handle] ?? null;
    }

    /**
     * Get all bootstrap settings classes
     * 
     * @return array
     */
    public function all(): array
    {
        return $this->_settings;
    }
}