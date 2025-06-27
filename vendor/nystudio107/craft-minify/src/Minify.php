<?php
/**
 * Minify plugin for Craft CMS
 *
 * @link      https://nystudio107.com/
 * @copyright Copyright (c) nystudio107
 * @license   MIT License https://opensource.org/licenses/MIT
 */

namespace nystudio107\minify;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use nystudio107\minify\models\Settings;
use nystudio107\minify\services\ServicesTrait;
use nystudio107\minify\twigextensions\MinifyTwigExtension;

/**
 * Class Minify
 *
 * @author    nystudio107
 * @package   Minify
 * @since     1.2.0
 *
 * @method Settings getSettings()
 */
class Minify extends Plugin
{
    // Traits
    // =========================================================================

    use ServicesTrait;

    // Static Properties
    // =========================================================================

    /**
     * @var Minify
     */
    public static Minify $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSettings = false;
    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;
        $this->name = $this->getName();

        // Add in our Twig extensions
        Craft::$app->view->registerTwigExtension(new MinifyTwigExtension());

        Craft::info(
            Craft::t(
                'minify',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    /**
     * Returns the user-facing name of the plugin, which can override the name
     * in composer.json
     *
     * @return string
     */
    public function getName(): string
    {
        return Craft::t('minify', 'Minify');
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inerhitDoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }
}
