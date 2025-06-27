<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\helpers;

use Craft;
use craft\base\SavableComponent;
use craft\events\RegisterComponentTypesEvent;
use putyourlightson\blitz\Blitz;
use putyourlightson\blitz\drivers\generators\HttpGenerator;
use putyourlightson\blitz\drivers\generators\LocalGenerator;
use yii\base\Event;

class CacheGeneratorHelper extends BaseDriverHelper
{
    /**
     * const string
     */
    public const DRIVER_ID = 'cacheGenerator';

    /**
     * @event RegisterComponentTypesEvent
     */
    public const EVENT_REGISTER_GENERATOR_TYPES = 'registerGeneratorTypes';

    /**
     * Returns all generator types.
     *
     * @return string[]
     */
    public static function getAllTypes(): array
    {
        $generatorTypes = [
            HttpGenerator::class,
            LocalGenerator::class,
        ];

        $generatorTypes = array_unique(array_merge(
            $generatorTypes,
            Blitz::$plugin->settings->cacheGeneratorTypes,
        ), SORT_REGULAR);

        $event = new RegisterComponentTypesEvent([
            'types' => $generatorTypes,
        ]);
        Event::trigger(static::class, self::EVENT_REGISTER_GENERATOR_TYPES, $event);

        return $event->types;
    }

    /**
     * Returns all generator drivers.
     *
     * @return SavableComponent[]
     */
    public static function getAllDrivers(): array
    {
        return self::createDrivers(self::getAllTypes());
    }

    /**
     * Adds a generator job to the queue.
     */
    public static function addGeneratorJob(array $siteUris, string $driverMethod, int $priority = null): void
    {
        $description = Craft::t('blitz', 'Generating Blitz cache');

        self::addDriverJob($siteUris, self::DRIVER_ID, $driverMethod, $description, $priority);
    }

    /**
     * Releases generator jobs from the queue.
     */
    public static function releaseGeneratorJobs(): void
    {
        self::releaseDriverJobs(self::DRIVER_ID);
    }
}
