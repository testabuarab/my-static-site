<?php
/**
 * Minify plugin for Craft CMS
 *
 * @link      https://nystudio107.com/
 * @copyright Copyright (c) nystudio107
 * @license   MIT License https://opensource.org/licenses/MIT
 */

namespace nystudio107\minify\models;

use craft\base\Model;

/**
 * Minify Settings model
 *
 * @author    nystudio107
 * @package   Minify
 * @since     1.2.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * If set to `true` then Minify will not minify anything
     *
     * @var bool
     */
    public bool $disableTemplateMinifying = false;

    /**
     * If set to `true` then Minify will not minify anything if `devMode` is enabled
     *
     * @var bool
     */
    public bool $disableDevModeMinifying = true;


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['disableTemplateMinifying', 'boolean'],
            ['disableTemplateMinifying', 'default', 'value' => false],
            ['disableDevModeMinifying', 'boolean'],
            ['disableDevModeMinifying', 'default', 'value' => true],
        ];
    }
}
