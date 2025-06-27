<?php

$vendorDir = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));

return array (
  'craftcms/redactor' => 
  array (
    'class' => 'craft\\redactor\\Plugin',
    'basePath' => $vendorDir . '/craftcms/redactor/src',
    'handle' => 'redactor',
    'aliases' => 
    array (
      '@craft/redactor' => $vendorDir . '/craftcms/redactor/src',
    ),
    'name' => 'Redactor',
    'version' => '3.0.4',
    'description' => 'Edit rich text content in Craft CMS using Redactor by Imperavi.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/redactor/blob/v2/README.md',
  ),
  'carlcs/craft-redactorcustomstyles' => 
  array (
    'class' => 'carlcs\\redactorcustomstyles\\Plugin',
    'basePath' => $vendorDir . '/carlcs/craft-redactorcustomstyles/src',
    'handle' => 'redactor-custom-styles',
    'aliases' => 
    array (
      '@carlcs/redactorcustomstyles' => $vendorDir . '/carlcs/craft-redactorcustomstyles/src',
    ),
    'name' => 'Redactor Custom Styles',
    'version' => '4.0.3',
    'description' => 'Redactor Custom Styles plugin for Craft CMS',
    'developer' => 'carlcs',
    'developerUrl' => 'https://github.com/carlcs',
    'documentationUrl' => 'https://github.com/carlcs/craft-redactorcustomstyles',
  ),
  'ryssbowh/craft-redactor-fa-api' => 
  array (
    'class' => 'Ryssbowh\\RedactorFa\\RedactorFa',
    'basePath' => $vendorDir . '/ryssbowh/craft-redactor-fa-api/src',
    'handle' => 'redactor-fa-api',
    'aliases' => 
    array (
      '@Ryssbowh/RedactorFa' => $vendorDir . '/ryssbowh/craft-redactor-fa-api/src',
    ),
    'name' => 'Font Awesome for Redactor',
    'version' => '2.0.2',
    'description' => 'Integrate font awesome to redactor through API',
    'developer' => 'The Web Puzzlers',
    'developerUrl' => 'https://puzzlers.run',
    'documentationUrl' => 'https://puzzlers.run/plugins/font-awesome-for-redactor',
  ),
  'cbp/redactor-fa-list' => 
  array (
    'class' => 'cbp\\redactorFaList\\Plugin',
    'basePath' => $vendorDir . '/cbp/redactor-fa-list/src',
    'handle' => 'redactor-fa-list',
    'aliases' => 
    array (
      '@cbp/redactorFaList' => $vendorDir . '/cbp/redactor-fa-list/src',
    ),
    'name' => 'Redactor FA List',
    'version' => '2.0.1',
    'description' => 'Adds a way to add font awesome icons as list markers in Redactor.',
    'developer' => 'Dan Brellis',
    'developerUrl' => 'https://github.com/danbrellis',
    'documentationUrl' => 'https://github.com/danbrellis/craft-redactor-fa-list/blob/main/README.md',
  ),
  'codemonauts/craft-redactor-nofollow' => 
  array (
    'class' => 'codemonauts\\nofollow\\Nofollow',
    'basePath' => $vendorDir . '/codemonauts/craft-redactor-nofollow/src',
    'handle' => 'nofollow',
    'aliases' => 
    array (
      '@codemonauts/nofollow' => $vendorDir . '/codemonauts/craft-redactor-nofollow/src',
    ),
    'name' => 'Redactor nofollow link plugin',
    'version' => '2.1.0',
    'description' => 'Craft CMS plugin to extends the Redactor\'s link module with the nofollow relationship attribute.',
    'developer' => 'codemonauts',
    'developerUrl' => 'https://codemonauts.com',
    'documentationUrl' => 'https://github.com/codemonauts/craft-redactor-nofollow/blob/master/README.md',
  ),
  'internetztube/craft-element-relations' => 
  array (
    'class' => 'internetztube\\elementRelations\\ElementRelations',
    'basePath' => $vendorDir . '/internetztube/craft-element-relations/src',
    'handle' => 'element-relations',
    'aliases' => 
    array (
      '@internetztube/elementRelations' => $vendorDir . '/internetztube/craft-element-relations/src',
    ),
    'name' => 'Element Relations',
    'version' => '2.0.2',
    'description' => 'Shows all relations of an element.',
    'developer' => 'Frederic Koeberl',
    'developerUrl' => 'https://frederickoeberl.com/',
    'documentationUrl' => 'https://github.com/internetztube/craft-element-relations/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/internetztube/craft-element-relations/master/CHANGELOG.md',
  ),
  'by/first-image' => 
  array (
    'class' => 'by\\firstimage\\FirstImage',
    'basePath' => $vendorDir . '/by/first-image/src',
    'handle' => 'first-image',
    'aliases' => 
    array (
      '@by/firstimage' => $vendorDir . '/by/first-image/src',
    ),
    'name' => 'First Image',
    'version' => '2.0.0',
    'description' => 'A plugin to get first image from Redactor Field.',
    'developer' => 'Bhashkar Yadav',
    'developerUrl' => 'https://360adaptive.com',
    'documentationUrl' => 'https://github.com/bhashkar007/first-image/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/bhashkar007/first-image/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
  ),
  'venveo/craft-bulkedit' => 
  array (
    'class' => 'venveo\\bulkedit\\Plugin',
    'basePath' => $vendorDir . '/venveo/craft-bulkedit/src',
    'handle' => 'venveo-bulk-edit',
    'aliases' => 
    array (
      '@venveo/bulkedit' => $vendorDir . '/venveo/craft-bulkedit/src',
    ),
    'name' => 'Bulk Edit',
    'version' => '4.0.1',
    'description' => 'Bulk edit Craft CMS element fields',
    'developer' => 'Venveo',
    'developerUrl' => 'https://venveo.com',
    'documentationUrl' => 'https://github.com/venveo/craft-bulkedit/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/venveo/craft-bulkedit/master/CHANGELOG.md',
  ),
  'doublesecretagency/craft-cpcss' => 
  array (
    'class' => 'doublesecretagency\\cpcss\\CpCss',
    'basePath' => $vendorDir . '/doublesecretagency/craft-cpcss/src',
    'handle' => 'cp-css',
    'aliases' => 
    array (
      '@doublesecretagency/cpcss' => $vendorDir . '/doublesecretagency/craft-cpcss/src',
    ),
    'name' => 'Control Panel CSS',
    'version' => '2.6.0',
    'schemaVersion' => '2.0.0',
    'description' => 'Add custom CSS to your Control Panel.',
    'developer' => 'Double Secret Agency',
    'developerUrl' => 'https://www.doublesecretagency.com/plugins',
    'documentationUrl' => 'https://github.com/doublesecretagency/craft-cpcss/blob/v2/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/doublesecretagency/craft-cpcss/v2/CHANGELOG.md',
  ),
  'presseddigital/colorit' => 
  array (
    'class' => 'presseddigital\\colorit\\Colorit',
    'basePath' => $vendorDir . '/presseddigital/colorit/src',
    'handle' => 'colorit',
    'aliases' => 
    array (
      '@presseddigital/colorit' => $vendorDir . '/presseddigital/colorit/src',
      '@fruitstudios/colorit' => $vendorDir . '/presseddigital/colorit/src_legacy',
    ),
    'name' => 'Colorit',
    'version' => '4.0.0',
    'description' => 'A slick color picker fieldtype plugin for the Craft CMS 4 control panel.',
    'developer' => 'Pressed Digital',
    'developerUrl' => 'https://presseddigital.co.uk',
    'documentationUrl' => 'https://github.com/presseddigital/colorit/blob/v4/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/presseddigital/colorit/v4/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => false,
  ),
  'doublesecretagency/craft-cpjs' => 
  array (
    'class' => 'doublesecretagency\\cpjs\\CpJs',
    'basePath' => $vendorDir . '/doublesecretagency/craft-cpjs/src',
    'handle' => 'cp-js',
    'aliases' => 
    array (
      '@doublesecretagency/cpjs' => $vendorDir . '/doublesecretagency/craft-cpjs/src',
    ),
    'name' => 'Control Panel JS',
    'version' => '2.6.0',
    'schemaVersion' => '2.0.0',
    'description' => 'Add custom JavaScript to your Control Panel.',
    'developer' => 'Double Secret Agency',
    'developerUrl' => 'https://www.doublesecretagency.com/plugins',
    'documentationUrl' => 'https://github.com/doublesecretagency/craft-cpjs/blob/v2/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/doublesecretagency/craft-cpjs/v2/CHANGELOG.md',
  ),
  'belniakmedia/remarry-twig-filter' => 
  array (
    'class' => 'belniakmedia\\remarrytwigfilter\\RemarryTwigFilter',
    'basePath' => $vendorDir . '/belniakmedia/remarry-twig-filter/src',
    'handle' => 'remarry-twig-filter',
    'aliases' => 
    array (
      '@belniakmedia/remarrytwigfilter' => $vendorDir . '/belniakmedia/remarry-twig-filter/src',
    ),
    'name' => 'remarry Twig Filter',
    'version' => '2.1.1',
    'description' => 'A CraftCMS Twig Filter that prevents paragraph text widows in plain text and complex HTML user supplied content.',
    'developer' => 'Rick Kukiela of Belniak Media Inc.',
    'developerUrl' => 'https://www.belniakmedia.com',
    'developerEmail' => 'rick@belniakmedia.com',
    'documentationUrl' => 'https://github.com/BelniakMedia/RemarryFilter/blob/master/README.md',
  ),
  'abmat/craft-tinymce' => 
  array (
    'class' => 'abmat\\tinymce\\Plugin',
    'basePath' => $vendorDir . '/abmat/craft-tinymce/src',
    'handle' => 'abm-tinymce',
    'aliases' => 
    array (
      '@abmat/tinymce' => $vendorDir . '/abmat/craft-tinymce/src',
    ),
    'name' => 'TinyMCE editor field',
    'version' => '1.0.8',
    'description' => 'TinyMCE Field for Craft CMS',
    'developer' => 'ABM Feregyhazy & Simon GmbH',
    'developerUrl' => 'https://www.abm.at',
  ),
  'doublesecretagency/craft-starratings' => 
  array (
    'class' => 'doublesecretagency\\starratings\\StarRatings',
    'basePath' => $vendorDir . '/doublesecretagency/craft-starratings/src',
    'handle' => 'star-ratings',
    'aliases' => 
    array (
      '@doublesecretagency/starratings' => $vendorDir . '/doublesecretagency/craft-starratings/src',
    ),
    'name' => 'Star Ratings',
    'version' => '2.3.3',
    'description' => 'An easy to use and highly flexible ratings system.',
    'developer' => 'Double Secret Agency',
    'developerUrl' => 'https://www.doublesecretagency.com/plugins',
    'documentationUrl' => 'https://www.doublesecretagency.com/plugins/star-ratings/docs',
  ),
  'doublesecretagency/craft-viewcount' => 
  array (
    'class' => 'doublesecretagency\\viewcount\\ViewCount',
    'basePath' => $vendorDir . '/doublesecretagency/craft-viewcount/src',
    'handle' => 'view-count',
    'aliases' => 
    array (
      '@doublesecretagency/viewcount' => $vendorDir . '/doublesecretagency/craft-viewcount/src',
    ),
    'name' => 'View Count',
    'version' => '1.2.2',
    'description' => 'Count the number of times an element has been viewed.',
    'developer' => 'Double Secret Agency',
    'developerUrl' => 'https://www.doublesecretagency.com/plugins',
    'documentationUrl' => 'https://www.doublesecretagency.com/plugins/view-count/docs',
  ),
  'craftcms/feed-me' => 
  array (
    'class' => 'craft\\feedme\\Plugin',
    'basePath' => $vendorDir . '/craftcms/feed-me/src',
    'handle' => 'feed-me',
    'aliases' => 
    array (
      '@craft/feedme' => $vendorDir . '/craftcms/feed-me/src',
    ),
    'name' => 'Feed Me',
    'version' => '5.3.0',
    'description' => 'Import content from XML, RSS, CSV or JSON feeds into entries, categories, Craft Commerce products, and more.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://docs.craftcms.com/feed-me/v4/',
  ),
  'mmikkel/retcon' => 
  array (
    'class' => 'mmikkel\\retcon\\Retcon',
    'basePath' => $vendorDir . '/mmikkel/retcon/src',
    'handle' => 'retcon',
    'aliases' => 
    array (
      '@mmikkel/retcon' => $vendorDir . '/mmikkel/retcon/src',
    ),
    'name' => 'Retcon',
    'version' => '2.7.5',
    'schemaVersion' => '1.0.0',
    'description' => 'Powerful Twig filters for mutating and querying HTML',
    'developer' => 'Mats Mikkel Rummelhoff',
    'developerUrl' => 'https://vaersaagod.no',
    'documentationUrl' => 'https://github.com/mmikkel/Retcon-Craft/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/mmikkel/Retcon-Craft/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
    'components' => 
    array (
    ),
  ),
  'mutation/translate' => 
  array (
    'class' => 'mutation\\translate\\Translate',
    'basePath' => $vendorDir . '/mutation/translate/src',
    'handle' => 'translations-admin',
    'aliases' => 
    array (
      '@mutation/translate' => $vendorDir . '/mutation/translate/src',
    ),
    'name' => 'Translations admin',
    'version' => '3.2.2',
    'schemaVersion' => '1.1.0',
    'description' => 'Translate messages in the control panel',
    'developer' => 'Mutation Digitale',
    'developerUrl' => 'https://mutation.io/',
    'documentationUrl' => 'https://github.com/MutationDigitale/craft3-translate/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/MutationDigitale/craft3-translate/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => true,
  ),
  'nystudio107/craft-retour' => 
  array (
    'class' => 'nystudio107\\retour\\Retour',
    'basePath' => $vendorDir . '/nystudio107/craft-retour/src',
    'handle' => 'retour',
    'aliases' => 
    array (
      '@nystudio107/retour' => $vendorDir . '/nystudio107/craft-retour/src',
    ),
    'name' => 'Retour',
    'version' => '4.1.15',
    'description' => 'Retour allows you to intelligently redirect legacy URLs, so that you don\'t lose SEO value when rebuilding & restructuring a website',
    'developer' => 'nystudio107',
    'developerUrl' => 'https://nystudio107.com/',
    'documentationUrl' => 'https://nystudio107.com/docs/retour/',
  ),
  'pennebaker/craft-architect' => 
  array (
    'class' => 'pennebaker\\architect\\Architect',
    'basePath' => $vendorDir . '/pennebaker/craft-architect/src',
    'handle' => 'architect',
    'aliases' => 
    array (
      '@pennebaker/architect' => $vendorDir . '/pennebaker/craft-architect/src',
    ),
    'name' => 'Architect',
    'version' => '4.0.1',
    'schemaVersion' => '2.0.0',
    'description' => 'CraftCMS plugin to generate content models from JSON/YAML data.',
    'developer' => 'Pennebaker',
    'developerUrl' => 'https://pennebaker.com',
    'documentationUrl' => 'https://github.com/Pennebaker/craft-architect/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/Pennebaker/craft-architect/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => true,
    'components' => 
    array (
      'architectService' => 'pennebaker\\architect\\services\\ArchitectService',
    ),
  ),
  'putyourlightson/craft-blitz' => 
  array (
    'class' => 'putyourlightson\\blitz\\Blitz',
    'basePath' => $vendorDir . '/putyourlightson/craft-blitz/src',
    'handle' => 'blitz',
    'aliases' => 
    array (
      '@putyourlightson/blitz' => $vendorDir . '/putyourlightson/craft-blitz/src',
    ),
    'name' => 'Blitz',
    'version' => '4.11.1',
    'description' => 'Intelligent static page caching for creating lightning-fast sites.',
    'developer' => 'PutYourLightsOn',
    'developerUrl' => 'https://putyourlightson.com/',
    'documentationUrl' => 'https://putyourlightson.com/plugins/blitz',
    'changelogUrl' => 'https://raw.githubusercontent.com/putyourlightson/craft-blitz/v4/CHANGELOG.md',
  ),
  'spacecatninja/imager-x' => 
  array (
    'class' => 'spacecatninja\\imagerx\\ImagerX',
    'basePath' => $vendorDir . '/spacecatninja/imager-x/src',
    'handle' => 'imager-x',
    'aliases' => 
    array (
      '@spacecatninja/imagerx' => $vendorDir . '/spacecatninja/imager-x/src',
    ),
    'name' => 'Imager X',
    'version' => '4.3.1',
    'schemaVersion' => '4.0.0',
    'description' => 'Ninja powered image transforms.',
    'developer' => 'SPACECATNINJA',
    'developerUrl' => 'https://www.spacecat.ninja',
    'documentationUrl' => 'http://imager-x.spacecat.ninja/',
    'changelogUrl' => 'https://raw.githubusercontent.com/spacecatninja/craft-imager-x/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
    'components' => 
    array (
    ),
  ),
  'trendyminds/craft-palette' => 
  array (
    'class' => 'trendyminds\\palette\\Palette',
    'basePath' => $vendorDir . '/trendyminds/craft-palette/src',
    'handle' => 'palette',
    'aliases' => 
    array (
      '@trendyminds/palette' => $vendorDir . '/trendyminds/craft-palette/src',
    ),
    'name' => 'Palette',
    'version' => '3.2.2',
    'description' => 'A command palette to easily jump to specific areas within Craft',
    'developer' => 'TrendyMinds',
    'developerUrl' => 'https://trendyminds.com',
    'documentationUrl' => 'https://github.com/trendyminds/craft-palette/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/trendyminds/craft-palette/main/CHANGELOG.md',
  ),
  'utakka/redactor-anchors' => 
  array (
    'class' => 'heidkaemper\\redactoranchors\\RedactorAnchors',
    'basePath' => $vendorDir . '/utakka/redactor-anchors/dist',
    'handle' => 'redactor-anchors',
    'aliases' => 
    array (
      '@heidkaemper/redactoranchors' => $vendorDir . '/utakka/redactor-anchors/dist',
    ),
    'name' => 'Redactor Anchors',
    'version' => '1.4.3',
    'schemaVersion' => '2.0',
    'description' => 'Support for anchors in Craft CMS Redactor',
    'developer' => 'Lars Heidkämper',
    'developerUrl' => 'https://github.com/heidkaemper',
    'documentationUrl' => 'https://github.com/heidkaemper/craft-redactor-anchors/blob/master/README.md',
  ),
  'verbb/comments' => 
  array (
    'class' => 'verbb\\comments\\Comments',
    'basePath' => $vendorDir . '/verbb/comments/src',
    'handle' => 'comments',
    'aliases' => 
    array (
      '@verbb/comments' => $vendorDir . '/verbb/comments/src',
    ),
    'name' => 'Comments',
    'version' => '2.0.10',
    'description' => 'Add comments to your site.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/comments',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/comments/craft-4/CHANGELOG.md',
  ),
  'verbb/redactor-tweaks' => 
  array (
    'class' => 'verbb\\redactortweaks\\RedactorTweaks',
    'basePath' => $vendorDir . '/verbb/redactor-tweaks/src',
    'handle' => 'redactor-tweaks',
    'aliases' => 
    array (
      '@verbb/redactortweaks' => $vendorDir . '/verbb/redactor-tweaks/src',
    ),
    'name' => 'Redactor Tweaks',
    'version' => '3.0.1',
    'description' => 'A small Craft CMS plugin that provides some tweaks to the default Redactor II Rich Text fieldtype.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/redactor-tweaks',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/redactor-tweaks/craft-4/CHANGELOG.md',
  ),
  'verbb/super-table' => 
  array (
    'class' => 'verbb\\supertable\\SuperTable',
    'basePath' => $vendorDir . '/verbb/super-table/src',
    'handle' => 'super-table',
    'aliases' => 
    array (
      '@verbb/supertable' => $vendorDir . '/verbb/super-table/src',
    ),
    'name' => 'Super Table',
    'version' => '3.0.12',
    'description' => 'Super-charge your Craft workflow with Super Table. Use it to group fields together or build complex Matrix-in-Matrix solutions.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/super-table',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/super-table/craft-4/CHANGELOG.md',
  ),
  'verbb/icon-picker' => 
  array (
    'class' => 'verbb\\iconpicker\\IconPicker',
    'basePath' => $vendorDir . '/verbb/icon-picker/src',
    'handle' => 'icon-picker',
    'aliases' => 
    array (
      '@verbb/iconpicker' => $vendorDir . '/verbb/icon-picker/src',
    ),
    'name' => 'Icon Picker',
    'version' => '2.0.16',
    'description' => 'A slick field to pick icons from. Supports SVGs, Sprites, Webfonts, Font Awesome and more.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/icon-picker',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/icon-picker/craft-4/CHANGELOG.md',
  ),
  'luwes/craft-codemirror' => 
  array (
    'class' => 'luwes\\codemirror\\CodeMirror',
    'basePath' => $vendorDir . '/luwes/craft-codemirror/src',
    'handle' => 'code-mirror',
    'aliases' => 
    array (
      '@luwes/codemirror' => $vendorDir . '/luwes/craft-codemirror/src',
    ),
    'name' => 'CodeMirror',
    'version' => '2.0.0',
    'description' => 'Add the awesome in-browser code editor CodeMirror as a field type.',
    'developer' => 'Wesley Luyten',
    'developerUrl' => 'https://wesleyluyten.com',
    'documentationUrl' => 'https://github.com/luwes/craft-codemirror/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/luwes/craft-codemirror/master/CHANGELOG.md',
  ),
  'mmikkel/cp-field-inspect' => 
  array (
    'class' => 'mmikkel\\cpfieldinspect\\CpFieldInspect',
    'basePath' => $vendorDir . '/mmikkel/cp-field-inspect/src',
    'handle' => 'cp-field-inspect',
    'aliases' => 
    array (
      '@mmikkel/cpfieldinspect' => $vendorDir . '/mmikkel/cp-field-inspect/src',
    ),
    'name' => 'CP Field Inspect',
    'version' => '1.4.4',
    'schemaVersion' => '1.0.0',
    'description' => 'Inspect field handles and easily edit field and element source settings',
    'developer' => 'Mats Mikkel Rummelhoff',
    'developerUrl' => 'http://mmikkel.no',
    'documentationUrl' => 'https://github.com/mmikkel/CpFieldInspect-Craft/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/mmikkel/CpFieldInspect-Craft/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
  ),
  'verbb/tablemaker' => 
  array (
    'class' => 'verbb\\tablemaker\\TableMaker',
    'basePath' => $vendorDir . '/verbb/tablemaker/src',
    'handle' => 'tablemaker',
    'aliases' => 
    array (
      '@verbb/tablemaker' => $vendorDir . '/verbb/tablemaker/src',
    ),
    'name' => 'Table Maker',
    'version' => '4.0.8',
    'description' => 'Create customizable and user-defined table fields.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/tablemaker',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/tablemaker/craft-4/CHANGELOG.md',
  ),
  'nystudio107/craft-minify' => 
  array (
    'class' => 'nystudio107\\minify\\Minify',
    'basePath' => $vendorDir . '/nystudio107/craft-minify/src',
    'handle' => 'minify',
    'aliases' => 
    array (
      '@nystudio107/minify' => $vendorDir . '/nystudio107/craft-minify/src',
    ),
    'name' => 'Minify',
    'version' => '4.0.1',
    'description' => 'A simple plugin that allows you to minify blocks of HTML, CSS, and JS inline in Craft CMS templates.',
    'developer' => 'nystudio107',
    'developerUrl' => 'https://nystudio107.com/',
    'documentationUrl' => 'https://nystudio107.com/docs/minify/',
  ),
  'doublesecretagency/craft-upvote' => 
  array (
    'class' => 'doublesecretagency\\upvote\\Upvote',
    'basePath' => $vendorDir . '/doublesecretagency/craft-upvote/src',
    'handle' => 'upvote',
    'aliases' => 
    array (
      '@doublesecretagency/upvote' => $vendorDir . '/doublesecretagency/craft-upvote/src',
    ),
    'name' => 'Upvote',
    'version' => '2.3.2',
    'description' => 'Lets your users upvote/downvote, "like", or favorite any type of element.',
    'developer' => 'Double Secret Agency',
    'developerUrl' => 'https://www.doublesecretagency.com/plugins',
    'documentationUrl' => 'https://www.doublesecretagency.com/plugins/upvote/docs',
  ),
  'mmikkel/cache-flag' => 
  array (
    'class' => 'mmikkel\\cacheflag\\CacheFlag',
    'basePath' => $vendorDir . '/mmikkel/cache-flag/src',
    'handle' => 'cache-flag',
    'aliases' => 
    array (
      '@mmikkel/cacheflag' => $vendorDir . '/mmikkel/cache-flag/src',
    ),
    'name' => 'Cache Flag',
    'version' => '1.4.0',
    'schemaVersion' => '1.0.2',
    'description' => 'Cold template caches that can be flagged and automatically invalidated.',
    'developer' => 'Mats Mikkel Rummelhoff',
    'developerUrl' => 'https://vaersaagod.no',
    'documentationUrl' => 'https://github.com/mmikkel/CacheFlag-Craft3/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/mmikkel/CacheFlag-Craft3/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => true,
    'components' => 
    array (
    ),
  ),
  'putyourlightson/craft-cache-igniter' => 
  array (
    'class' => 'putyourlightson\\cacheigniter\\CacheIgniter',
    'basePath' => $vendorDir . '/putyourlightson/craft-cache-igniter/src',
    'handle' => 'cache-igniter',
    'aliases' => 
    array (
      '@putyourlightson/cacheigniter' => $vendorDir . '/putyourlightson/craft-cache-igniter/src',
    ),
    'name' => 'Cache Igniter',
    'version' => '1.1.2',
    'description' => 'A global CDN and reverse proxy cache warmer.',
    'developer' => 'PutYourLightsOn',
    'developerUrl' => 'https://putyourlightson.com/',
    'documentationUrl' => 'https://putyourlightson.com/plugins/cache-igniter',
    'changelogUrl' => 'https://raw.githubusercontent.com/putyourlightson/craft-cache-igniter/v1/CHANGELOG.md',
  ),
  'nystudio107/craft-emptycoalesce' => 
  array (
    'class' => 'nystudio107\\emptycoalesce\\EmptyCoalesce',
    'basePath' => $vendorDir . '/nystudio107/craft-emptycoalesce/src',
    'handle' => 'empty-coalesce',
    'aliases' => 
    array (
      '@nystudio107/emptycoalesce' => $vendorDir . '/nystudio107/craft-emptycoalesce/src',
    ),
    'name' => 'Empty Coalesce',
    'version' => '4.0.0',
    'description' => 'Empty Coalesce adds the ??? operator to Twig that will return the first thing that is defined, not null, and not empty.',
    'developer' => 'nystudio107',
    'developerUrl' => 'https://nystudio107.com/',
    'documentationUrl' => 'https://nystudio107.com/docs/empty-coalesce/',
  ),
  'topshelfcraft/scraper' => 
  array (
    'class' => 'TopShelfCraft\\Scraper\\Scraper',
    'basePath' => $vendorDir . '/topshelfcraft/scraper/src',
    'handle' => 'scraper',
    'aliases' => 
    array (
      '@TopShelfCraft/Scraper' => $vendorDir . '/topshelfcraft/scraper/src',
    ),
    'name' => 'Scraper',
    'version' => '4.0.0',
    'description' => 'Easily fetch, parse, and rejigger HTML or XML from anywhere.',
    'developer' => 'Top Shelf Craft (Michael Rog)',
    'developerUrl' => 'https://topshelfcraft.com',
    'documentationUrl' => 'https://github.com/TopShelfCraft/Scraper',
  ),
);
