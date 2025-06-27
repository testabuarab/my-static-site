<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\drivers\integrations;

interface IntegrationInterface
{
    /**
     * Returns the required plugins.
     *
     * Should return an array whose values can be either plugin handles or arrays
     * containing plugin handles and optionally version numbers. For example:
     *
     * - ['feed-me', 'seomatic']
     * - [['handle' => 'feed-me', 'version' => '4.0.0'], 'seomatic']
     */
    public static function getRequiredPlugins(): array;

    /**
     * Registers events.
     */
    public static function registerEvents();
}
