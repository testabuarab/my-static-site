<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitz\helpers;

use Craft;
use craft\base\SavableComponent;
use craft\events\RegisterComponentTypesEvent;
use putyourlightson\blitz\Blitz;
use putyourlightson\blitz\drivers\deployers\DummyDeployer;
use putyourlightson\blitz\drivers\deployers\GitDeployer;
use putyourlightson\blitz\models\SiteUriModel;
use yii\base\Event;

class DeployerHelper extends BaseDriverHelper
{
    /**
     * const string
     */
    public const DRIVER_ID = 'deployer';

    /**
     * @event RegisterComponentTypesEvent
     */
    public const EVENT_REGISTER_DEPLOYER_TYPES = 'registerDeployerTypes';

    /**
     * Returns all deployer types.
     *
     * @return string[]
     */
    public static function getAllTypes(): array
    {
        $deployerTypes = [
            DummyDeployer::class,
            GitDeployer::class,
        ];

        $deployerTypes = array_unique(array_merge(
            $deployerTypes,
            Blitz::$plugin->settings->deployerTypes
        ), SORT_REGULAR);

        $event = new RegisterComponentTypesEvent([
            'types' => $deployerTypes,
        ]);
        Event::trigger(static::class, self::EVENT_REGISTER_DEPLOYER_TYPES, $event);

        return $event->types;
    }

    /**
     * Returns all deployer drivers.
     *
     * @return SavableComponent[]
     */
    public static function getAllDrivers(): array
    {
        return self::createDrivers(self::getAllTypes());
    }

    /**
     * Adds a deploy job to the queue.
     *
     * @param SiteUriModel[] $siteUris
     */
    public static function addDeployerJob(array $siteUris, string $driverMethod, int $priority = null): void
    {
        $description = Craft::t('blitz', 'Deploying files');

        self::addDriverJob($siteUris, self::DRIVER_ID, $driverMethod, $description, $priority);
    }

    /**
     * Releases deployer jobs from the queue.
     */
    public static function releaseDeployerJobs(): void
    {
        self::releaseDriverJobs(self::DRIVER_ID);
    }
}
