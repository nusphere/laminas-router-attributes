<?php

declare(strict_types=1);

use Laminas\Router\Attributes\Test\Functional\Demo\Controller\DemoController;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            DemoController::class => InvokableFactory::class,
        ],
    ],
];
