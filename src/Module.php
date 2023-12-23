<?php

declare(strict_types=1);

namespace Laminas\Router\Annotations;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

use function dirname;

final class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }
}
