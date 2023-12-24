<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;
use Laminas\Router\Attributes\Listener\RoutingAttributesListener;

use function dirname;

final class Module implements ConfigProviderInterface, InitProviderInterface
{
    public function getConfig(): array
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }

    public function init(ModuleManagerInterface $manager): void
    {
        (new RoutingAttributesListener())->attach($manager->getEventManager());
    }
}
