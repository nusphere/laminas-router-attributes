<?php

declare(strict_types=1);

use Laminas\Router\Attributes\Test\Functional\Demo\Controller\DemoController;
use Laminas\Router\Attributes\Test\Functional\Demo\Controller\SymfonyDemoController;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            DemoController::class        => InvokableFactory::class,
            SymfonyDemoController::class => InvokableFactory::class,
        ],
    ],
];
