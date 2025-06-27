# Bootstrap Theme for Craft themes 3.x

This is an example theme for [Craft Themes](https://plugins.craftcms.com/themes) based on Boostrap 5 (5.1.3).

This theme harness the power of bootstrap into a reusable theme, most bootstrap variables are changeable in the backend and the theme integrate to bootstrap's components through its templates.  
This theme could be easily extend from in a custom theme of yours if you needed more control on the templates, using themes [templates inheritance](https://github.com/ryssbowh/craft-themes/wiki/Developers#templating-pro) and on the css/js which are kept to a minimum on purpose to keep options open.

This theme requires Craft Themes 3.x in Pro edition to use all its features but can be used in lite version too.

## Installation

You can install this theme as a composer package and have [your own theme](https://github.com/ryssbowh/craft-themes/wiki/Developers#creating-a-new-theme) extend from it

- `composer require ryssbowh/bootstrap-theme`

Or download it whole from this page and install it into your own theme folder. The previous link will show you how.  
Installing it like so will allow you to modify templates directly without having to define your own theme.

## Regions

Here are the regions defined by this theme :

![Regions](images/regions.png)

## Blocks

A new block provider (Bootstrap theme) is defined by this plugin, with 3 new blocks in it:

- PoweredByBootstrap: a simple link to bootstrap page, installed by default in the region 'Footer right'
- MainMenu: More an example than anything, installed in the 'Header middle' region, its template can be overridden like any other block
- FooterMenu: More an example than anything, installed in the 'Footer left' region, its template can be overridden like any other block

## 404, 500, 503 pages

Those 3 pages have a custom layout defined, which is manually loaded in their associated templates (404.twig, 500.twig and 503.twig).  
Their content is overridden by the templates `blocks/custom_404_system-content.twig`, `blocks/custom_500_system-content` and `blocks/custom_503_system-content`

## Settings

### Scss

Almost every bootstrap scss variable has been mapped into its own setting editable in the CP. All settings will take bootstrap's default if left unchanged.  
Saving these settings will generate a scss file which combined with bootstrap scss during compilation will change how things look like.

![Settings](images/settings.png)

After changing this settings the scss must be recompiled for changes to take effect, there are several ways to do this :
- Disable this plugin scss auto compilation and compile the scss using an external tool of your choice (webpack, gulp etc), you only need to include that generated file before bootstrap library to include the changes. The file is `assets/src/scss/resources-settings.scss` (that can be changed in the settings)
- Keep auto compilation either when you change settings or when the frontend is reloaded
- If you have a theme that extends from this plugin, simply import the generated file in your custom scss, the file will be found using scss file import inheritance.

You can add your own scss variables tab in the settings through events :

```
use Ryssbowh\BootstrapTheme\models\Settings;

class MySettingsTab extends BootstrapSettings
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'My tab';
    }

    /**
     * @inheritDoc
     */
    public function getHandle(): string
    {
        return 'my-tab'
    }

    /**
     * @inheritDoc
     */
    public function init()
    {
        //Valid values for 'type': text, date, time, color, dateTime, textarea, select, selectrgba, multiselect, checkbox, lightswitch, radioGroup, checkboxSelect, checkboxGroup, autosuggest
        $this->definitions = [
            'my-variable' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('My variable'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => $this->t('default')])
                ]
            ],
            //Select dropdown using all defined colors :
            'my-color' => [
                'type' => 'select',
                'value' => '$blue',
                'options' => [
                    'label' => $this->t('My color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'Blue']),
                    'values' => '#colors'
                ]
            ],
            //Rgba colors also shows an opacity input :
            'rgba-color' => [
                'type' => 'selectrgba',
                'options' => [
                    'label' => $this->t('Rgba color'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'rgba($black, .125)']),
                    'options' => '#colors'
                ]
            ],
            //Select dropdown using all defined fonts
            'my-font' => [
                'type' => 'select',
                'options' => [
                    'label' => $this->t('My font'),
                    'options' => '#fonts',
                    'tip' => $this->t('Make sure it\'s enabled in the main settings'),
                ]
            ],
            //Custom function to generate the value
            'rgba-color' => [
                'type' => 'text',
                'options' => [
                    'label' => $this->t('Custom variable'),
                    'instructions' => $this->t('Defaults to {default}', ['default' => 'my-mixin($variable, 10%)'])
                ],
                'valueCallback' => function ($value, $settings) {
                    return 'my-mixin(' . $value . ', 10%)';
                }
            ],
        ];
    }
}

Event::on(Settings::class, Settings::EVENT_SETTINGS, function (SettingsEvent $e) {
    $e->add(new MySettingsTab);
});
```
Or modify existing ones :

```
Event::on(Settings::class, Settings::EVENT_SETTINGS, function (SettingsEvent $e) {
    $colors = $e->get('colors');
    $colors->definitions[] = [
        'my-color' => [
            'value' => '#ffffff',
            'type' => 'color',
            'baseColor' => true, //Base colors will show into every color dropdowns
            'options' => [
                'label' => $this->t('My color')
            ]
        ]
    ];
});
```

### Fonts

You can add downloable fonts with the same event, those fonts will become available to choose from in the settings, and will be automatically added on the frontend if selected :
```
Event::on(Settings::class, Settings::EVENT_SETTINGS, function (SettingsEvent $e) {
    $e->fonts[] = [
        'ubuntu' => [
            'fonts' => [
                'Roboto',
            ],
            'url' => 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'
        ],
    ];
});
```

## Displayers

**New displayers :**  
- [Carousel](https://getbootstrap.com/docs/5.0/components/carousel/), for Assets fields.  
- [Accordion](https://getbootstrap.com/docs/5.0/components/accordion/) for Assets, Categories, Entries, Matrix and Users fields.  
- [Card](https://getbootstrap.com/docs/5.0/components/card/) for Assets, Categories, Entries, Matrix and Users fields.  
- [List Group](https://getbootstrap.com/docs/5.0/components/list-group/) for Assets, Categories, Entries, Matrix, Tags and Users fields.  

The field displayers ElementLink, UrlLink, ElementLinks, Email and the file displayer Link now have [buttons](https://getbootstrap.com/docs/5.0/components/buttons/) options :  
- Display as button
- Color
- Size
- Outlined

The TagLabel displayer now have [badge](https://getbootstrap.com/docs/5.0/components/badge/) options :  
- Display as badge
- Background color
- Pill (rounded)

## Bootstrap components

Several templates are available to include or extend from in the [components folder](src/templates/front/components)
- [alert](https://getbootstrap.com/docs/5.0/components/alerts/)
- [badge](https://getbootstrap.com/docs/5.0/components/badge/)
- [breadcrumbs](https://getbootstrap.com/docs/5.0/components/breadcrumb/)
- [button](https://getbootstrap.com/docs/5.0/components/buttons/)
- [dropdowns](https://getbootstrap.com/docs/5.0/components/dropdowns/)
- [list groups](https://getbootstrap.com/docs/5.0/components/list-group/)
- [modal](https://getbootstrap.com/docs/5.0/components/modal/)
- [nav](https://getbootstrap.com/docs/5.0/components/navs-tabs/)
- [offcanvas](https://getbootstrap.com/docs/5.0/components/offcanvas/)
- [pagination](https://getbootstrap.com/docs/5.0/components/pagination/)
- [progressbar](https://getbootstrap.com/docs/5.0/components/progress/)
- [spinner](https://getbootstrap.com/docs/5.0/components/spinners/)
- [toast](https://getbootstrap.com/docs/5.0/components/toasts/)

[Tooltips](https://getbootstrap.com/docs/5.0/components/tooltips/) and [Popovers](https://getbootstrap.com/docs/5.0/components/popovers/) can be achieved with the [button component](src/templates/front/components/button.twig). They will be automatically initiated on page load.

View [components documentation](COMPONENTS.md)

## Assets

The `BootstrapJsAssets` bundle will include bootstrap javascript  
The `FrontCssAssets` bundle will include the scss compiled css, will compile them on the spot if enabled in the settings  
The `FrontJsAssets` will include a small amount of javascript to activate Popovers and Tooltips  
The `WebpackFrontAssets` will include assets generated by webpack, this is more an example than anything else