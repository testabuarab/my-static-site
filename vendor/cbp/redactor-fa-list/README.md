<p align="center"><img src="./src/icon.svg" width="100" height="100" alt="Redactor Font Awesome List icon"></p>

# Redactor Font Awesome List

This redactor plugin allows you to add Font Awesome icons as markers for your redactor lists.

Will generate HTML through a simple icon picker:

```html
<ul class="fa-ul">
    <li><span class="fa-li"><i class="fas fa-check"></i></span> List item 1</li>
    <li><span class="fa-li"><i class="fas fa-check"></i></span> List item 2</li>
    <li><span class="fa-li"><i class="fas fa-times"></i></span> List item 3</li>
</ul>
```
See Font Awesome's [Icons in a List](https://fontawesome.com/how-to-use/on-the-web/styling/icons-in-a-list).
    
## Requirements
This plugin requires Craft CMS 3.1 or later as well as the [Craft Redactor plugin](https://github.com/craftcms/redactor) v2.0 or later.

## Installation
Install through the Plugin Store.

Alternatively, you can download and install this plugin with Composer.

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project

# tell Composer to load the plugin
composer require cbp/redactor-fa-list

# tell Craft to install the plugin
./craft plugin/install redactor-fa-list
```

## Adding to your Redactor fields
Include the plugin in your Redactor config file located in `config/redactor/Default.json`. To do so, add `"falist"` in the plugins array:

```json
{
  "buttons": ["html"],
  "plugins": ["fullscreen", "falist"]
}
```

**NOTE:** Don't forget to include Font Awesome on your front-end.

## Allow Certain Icons and Styles
By default, over 1000 Font Awesome icons are available to be selected from within the field. If you want to limit which icons your authors can select, you can [override the setting value](https://craftcms.com/docs/3.x/extend/plugin-settings.html#overriding-setting-values).

Create a new file `config/redactor-fa-list.php`:

```php
return [
    'icons' => [
        "heart",
        "star"
    ]
];
```
If only a string is provided (as above), it will default to the Solid (`.fas`) styling. To specify styled icons, use a `key => value` pair:

```php
return [
    'icons' => [
        ["heart" => "fal"], // this will be the Light style
        ["heart" => "fad"], // this will be the Duotone style
        "star", // this defaults to Solid style
        ["creative-commons" => "fab"] // this will be the Brands style
    ]
];
```

### Specify Versions

Since, by default, only free Solid styles are assumed, the [Font Awesome CSS webfont](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css) is loaded to display icons in the redactor field automatically. If you choose to use other icon styles or target a specific version of FA, you need to include the proper CSS file(s) in your settings override:

```php
//Using Webfont CDN
use craft\helpers\App;
return [
    'icons' => [
        ["alien" => "fad"],
        ["creative-commons" => "fab"]
    ],
    'styles' => [
        [
            'src' => "https://pro.fontawesome.com/releases/v5.15.3/css/all.css",
            'params' => [
                'integrity' => App::env('FA_INTEGRITY'),
                'crossorigin' => "anonymous"
            ]
        ],
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css'
    ]
];
```

**NOTE:** Currently there are too many bugs with using FA Kits with the redactor fields, so support was removed in v1.0.4 of this plugin. However, just because you use the webfont CDN on the backend doesn't mean you can't use the FA Kit script for your frontend :)