<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use craft\helpers\App;
//use USChamber\ComponentLibrary\ComponentLibrary;
return [
    'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',
    'modules' => [
/*        'my-module' => \modules\Module::class,*/
        'site-module' => [
            'class' => \modules\sitemodule\SiteModule::class,
        ],
        //'component-library' => ComponentLibrary::class,
      //  'cp-body-classes' => \modules\cpbodyclasses\CpBodyClasses::class,
       // 'page-blocks' => \modules\pageblocks\PageBlocks::class,
      //  'layout-context' => \modules\layoutcontext\LayoutContext::class,
      //  'page-context' => \modules\pagecontext\PageContext::class,
      //  'component-library' => ComponentLibrary::class,
    ],
    'bootstrap' => ['site-module'],
    'components' => [
        'db' => function () {
            $config = craft\helpers\App::dbConfig();
            //   $config['enableSchemaCache'] = true;
            $config['schemaCacheDuration'] = 60 * 60 * 24; // 1 day
            return Craft::createObject($config);
        },
      /*  'deprecator' => [
            'throwExceptions' => App::env('HARD_MODE') ?: false,
        ],*/
        'queue' => [
            'class' => craft\queue\Queue::class,
            'ttr' => 10 * 60,
        ],
		 /*  'cache' => function() {
            $config = [
                'class' => yii\redis\Cache::class,
                'keyPrefix' => Craft::$app->id,
                'defaultDuration' => Craft::$app->config->general->cacheDuration,

                // Full Redis connection details:
                'redis' => [
                    'hostname' => App::env('REDIS_HOSTNAME') ?: 'localhost',
                    'port' => 6379,
                    'password' => App::env('REDIS_PASSWORD') ?: null,
                ],
            ];

            return Craft::createObject($config);
        },
        'redis' => [
               'class' => yii\redis\Connection::class,
               'hostname' => App::env('REDIS_HOSTNAME'),
               'port' => App::env('REDIS_PORT'),
               'database' => App::env('REDIS_DEFAULT_DB'),
           ],
           'cache' => [
               'class' => yii\redis\Cache::class,
               'keyPrefix' => '_' . App::env('CRAFT_APP_ID') . '_CACHE_' ?: 'CraftCMS_CACHE_',
               'defaultDuration' => 86400,
               'redis' => 'redis',
           ],
           'mutex' => static function() {
               $config = [
                   'class' => craft\mutex\Mutex::class,
                   'mutex' => [
                       'class' => yii\redis\Mutex::class,
                       // set the max duration to 15 minutes for console requests
                       'expire' => Craft::$app->request->isConsoleRequest ? 900 : 30,
                       'redis' => [
                           'hostname' => App::env('REDIS_HOSTNAME') ?: 'localhost',
                           'port' => App::env('REDIS_PORT'),
                           'password' => App::env('REDIS_PASSWORD') ?: null,
                           'database' => App::env('REDIS_DEFAULT_DB'),
                       ],
                   ],
               ];

               // Return the initialized component:
               return Craft::createObject($config);
           },*/
    ],
/*    'components' => [
        'log' => [
            // Include this many levels of the call stack:
            'traceLevel' => 5,
        ],
    ],*/
    //'bootstrap' => ['my-module'],
];
