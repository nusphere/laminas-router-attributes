<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Loader;

use ReflectionClass;
use ReflectionMethod;
use Symfony\Component\Routing\Loader\AttributeClassLoader;
use Symfony\Component\Routing\Route;

use function str_replace;

class AttributesClassLoader extends AttributeClassLoader
{
    protected function configureRoute(
        Route $route,
        ReflectionClass $class,
        ReflectionMethod $method,
        object $annot
    ): void {
        $route->setDefaults([
            'controller' => $class->name,
            'action'     => str_replace('Action', '', $method->name),
        ]);
    }
}
