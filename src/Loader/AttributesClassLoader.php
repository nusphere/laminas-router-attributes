<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Loader;

use ReflectionClass;
use ReflectionMethod;
use Symfony\Component\Routing\Loader\AttributeClassLoader;
use Symfony\Component\Routing\Route;

use function array_keys;
use function count;
use function preg_match_all;
use function str_replace;

final class AttributesClassLoader extends AttributeClassLoader
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

        // inline default functionality
        preg_match_all('/{(\w+)\?(\w+)}/', $annot->getPath(), $outputArray);

        if (count($outputArray[0]) > 0) {
            foreach (array_keys($outputArray[0]) as $optionalKey) {
                $route->setDefault($outputArray[1][$optionalKey], $outputArray[2][$optionalKey]);
            }
        }

        // Attribute defaults setting
        if (count($annot->getDefaults()) > 0) {
            foreach ($annot->getDefaults() as $key => $value) {
                $route->setDefault($key, $value);
            }
        }
    }
}
