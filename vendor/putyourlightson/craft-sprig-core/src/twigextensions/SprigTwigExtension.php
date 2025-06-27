<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\sprig\twigextensions;

use putyourlightson\sprig\Sprig;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class SprigTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('sprig', [Sprig::$core->components, 'create']),
        ];
    }

    /**
     * Returns the globals to add.
     */
    public function getGlobals(): array
    {
        return [
            'sprig' => Sprig::$sprigVariable,
        ];
    }
}
