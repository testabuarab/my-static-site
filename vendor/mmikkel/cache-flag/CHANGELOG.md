# Cache Flag Changelog

## 1.4.0 - 2023-07-04
### Changed
- The Cache Flag CP section is now available in environments where admin changes are disallowed (saving flags isn't possible unless `allowAdminChanges` is set to `true`, but invalidating flagged caches is)  

## 1.3.4 - 2023-04-24
### Fixed 
- Fixed a PHP exception that could occur when saving or deleting nested elements with invalid owner IDs. #21

## 1.3.3 - 2023-02-11
### Fixed
- Fixed a PHP exception that would occur when invalidating flagged caches via the `caches/invalidate` HTTP controller action, on Craft 4. Fixes #19

## 1.3.2 - 2022-09-18
### Fixed 
- Fixed an issue that could occur when upgrading from Craft 2 to Craft 3.  

## 1.3.1 - 2022-06-20

> {warning} Prior to Craft 3.5.0, Cache Flag used a database table called `cacheflag_flagged` to store references to template caches in the `templatecaches` database table. **If present, this table will cause a migration error when upgrading to Craft 4.** To avoid the issue, make sure to upgrade to Cache Flag 1.3.1 or later **before** upgrading the site to Craft 4. _Note that this only applies to sites that were initially running Craft 3.4.x or earlier (and had Cache Flag v. 1.0.4 or earlier installed at that time)._  

### Fixed  
- CacheFlag will now delete the old `cacheflag_flagged` database table upon installation or update, preventing a migration error when upgrading sites to Craft 4.  

## 1.3.0 - 2022-04-18
### Added  
- Adds Craft 4.0 compatibility

### Changed  
- Updated plugin icon

## 1.2.4 - 2020-12-28    

### Fixed  
- Fixes a migration SQL issue. Fixes #12  

### Changed  
- Cache Flag no longer triggers the deprecated `EVENT_BEFORE_DELETE_FLAGGED_CACHES` and `EVENT_AFTER_DELETE_FLAGGED_CACHES` events. Fixes #13  

## 1.2.3 - 2020-08-21

### Fixed

- Fixes an SQL issue that could occur when applying Project Config changes  

## 1.2.2 - 2020-08-21  

### Fixed

- Fixes an issue where some of Cache Flag's database migrations would not run properly (causing an SQL error), if the plugin was upgraded in an environment where the Project Config Yaml files already had been updated with Cache Flag's latest schema version  

## 1.2.1 - 2020-07-31  

> {warning} Craft 3.5.0 has a new template caching system with [a tag-based cache invalidation strategy](https://github.com/craftcms/cms/issues/1507#issuecomment-633147835), which solves the performance issues related to automatic cache busting using the native `{% cache %}` tag in previous Craft versions. **If you're currently using this plugin only to circumvent said performance issues, you probably don't need Cache Flag anymore.**  That said, Cache Flag is fully compatible with Craft 3.5 and is still a valid alternative to the native `{% cache %}` tag, e.g. for automatic bulk cache invalidation or completely "cold" template caches.  

### Changed

- Moved the "Flagged template caches" option to the new "Invalidate Data Caches" option group in the Clear Caches utility  
- Cache Flag now requires Craft 3.5.0-RC5 or later  

## 1.2.0 - 2020-07-23  

### Added  
- Added Craft 2 migration (took me long enough)  
- Added support for Project Config  
- Added the ability to clear flagged caches via console  
- Added the ability to clear flagged caches over HTTP  

### Changed  
- The `{{%cacheflag_flags}}` database table now has default ActiveRecord audit columns (`dateCreated`, `dateUpdated` and `uid`)  

## 1.1.0 - 2020-07-21

### Added  
- Added the `with elements` directive to the `{% cacheflag %}` tag, which makes Cache Flag collect element tags for automatic cache invalidation (just like the native `{% cache %}` tag) in addition to your custom flags.  
- Added an option for invalidating flagged template caches to the native Clear Caches utility tool.  
- Added the ability to flag caches with dynamic flags using element IDs (or UIDs)  
- Added `\mmikkel\cacheflag\events\FlaggedTemplateCachesEvent`  
- Added `CacheFlagService::EVENT_BEFORE_INVALIDATE_FLAGGED_CACHES`  
- Added `CacheFlagService::EVENT_AFTER_INVALIDATE_FLAGGED_CACHES`  

### Changed  
- Cache Flag now has full Craft 3.5 compatibility, and uses Craft's new template cache system instead of storing template caches in the deprecated `templatecaches` database table  
- Cache Flag now requires Craft 3.5.0-RC1 or later  
- Cache Flag no longer invalidates caches when entry drafts or revisions are saved or deleted  
- The `cacheflag_flagged` database table has been deprecated  
- `\mmikkel\cacheflag\events\BeforeDeleteFlaggedTemplateCachesEvent` has been deprecated
- `\mmikkel\cacheflag\events\AfterDeleteFlaggedTemplateCachesEvent` has been deprecated  
- `CacheFlagService::EVENT_BEFORE_DELETE_FLAGGED_CACHES` has been deprecated  
- `CacheFlagService::EVENT_AFTER_DELETE_FLAGGED_CACHES` has been deprecated  

## 1.0.4 - 2020-07-16

### Fixed
- Fixes an issue where Cache Flag was unable to delete template caches on Craft 3.5.x

### Changed
- Cache Flag now requires Craft 3.4.27+

## 1.0.3 - 2018-10-03

### Fixed
- Fixes an issue where it was impossible to save multiple flags in environments running PHP 7.2

## 1.0.2 - 2018-09-21

### Fixed
- Fixes breaking SQL issues on installs running PostgreSQL (#1)
- Fixes a JavaScript issue in CacheFlag's CP section, where flag input fields could be cleared when saving flags
- Fixes a bug where CacheFlag would fail to break caches for sources with multiple flags

### Improved
- Adds additional, super fun random messages when flags are saved in the CP section. Those are entertaining, right?

## 1.0.1 - 2018-07-19

### Fixed
- Fixes various minor issues

## 1.0.0 - 2018-07-16

### Added
- Initial release for the Craft 3 port of Cache Flag

### Improved
- Caches created inside the `{% cacheflag %}` tag pair are now being stored in a single transaction, which should resolve a rare issue with orphaned template caches
- Changing the `flagged` attribute for an existing `{% cacheflag %}` tag will now result in a new cache (just like changing the `key` will for both`{% cache %}` and `{% cacheflag %}`)
- The "deleteFlaggedCaches" event has been to renamed "afterDeleteFlaggedCaches", for clarity
