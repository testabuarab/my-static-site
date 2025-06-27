
# Change Log
All notable changes to this project will be documented in this file.

## [2.0.1] - 2023-02-24

### Changed

- Requires craftcms/redactor version ^3.0
- Sets PHP requirement to 8.0.2

## [2.0.0] - 2023-02-24

### Changed

- Converts plugin into a Craft 4.0 plugin with PHP 8.0+ support.

## [1.0.5] - 2021-07-21

### Fixed

- Reverts change in v1.0.4 (commit 51a8132) which led to incorrectly registered js var

## [1.0.4] - 2021-06-15

### Added

- Adds support for CSS params

### Changed

- Moves script registration code into Redactor field event
- Removes support for FA kits (as of now) due to redactor's buggy autoparse with inline svgs

### Fixed

- Icon search in modal

## [1.0.3] - 2021-06-11

### Added

- Support for icon styles (solid, regular, light, duotone, and brand)
- Setting options to use a FA kit script or other webfonts from a CSS file

### Changed

- Styling for modal icon list

## [1.0.2] - 2021-03-25

### Added

- Adds settings to let site admins override the list of available icons in the redactor modal.

### Changed

- Renames redactor button to "Icon List"

### Fixed

- Removes id attributes from elements to eliminate conflict from multiple modals

## [1.0.1] - 2020-10-21

[Inital Release](https://github.com/danbrellis/craft-redactor-fa-list/releases/tag/v1.0.1)