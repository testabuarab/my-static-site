<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;
$isDev = App::env('CRAFT_ENVIRONMENT') === 'dev';
$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';
return GeneralConfig::create()
    // Set the default week start day for date pickers (0 = Sunday, 1 = Monday, etc.)
    ->devMode($isDev)
    ->allowUpdates($isDev)
    ->allowAdminChanges($isDev)
    ->enableTemplateCaching(!$isDev)
    ->enableGraphqlCaching(!$isDev)
    ->defaultWeekStartDay(1)
    ->isSystemLive(1)
    ->backupOnUpdate(0)
    //->headlessMode(App::env('HEADLESS_MODE') ?: false)
   /* ->allowedGraphqlOrigins([
        'http://localhost:3100',
    ])*/
    // ->runQueueAutomatically(1)
    ->cacheDuration(86400)
	->imageDriver('gd')
    ->maxRevisions(10)
    // ->defaultTokenDuration(86400)
    ->enableCsrfProtection(0)
	 ->cpTrigger('watsaaaaaaaaaaaaaaaaaaaaaaabplus')
    ->limitAutoSlugsToAscii(0)
    ->convertFilenamesToAscii(false)
    ->generateTransformsBeforePageLoad(true)
    ->maxCachedCloudImageSize(3000)
    ->maxUploadFileSize('100M')
    ->omitScriptNameInUrls(true)
    ->sendPoweredByHeader(false)
    ->useEmailAsUsername(false)
   // ->usePathInfo(true)
    ->extraAllowedFileExtensions(['apk','apks','apkx','woff','woff2','ttf','eot','css'])
    ->preventUserEnumeration(true)
 //  ->errorTemplatePrefix('errors/')
    ->defaultSearchTermOptions([
        'subLeft' => true,
        'subRight' => true,
    ])
   // ->disabledPlugins([
    //  'star-ratings'
    //])
    // Allow administrative changes
    ->allowAdminChanges(App::env('ALLOW_ADMIN_CHANGES') ?? false)
    // Disallow robots
    ->disallowRobots(App::env('DISALLOW_ROBOTS') ?? false)
;
