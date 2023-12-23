<?php

namespace Laminas\Router\Annotations;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

final class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }
}
