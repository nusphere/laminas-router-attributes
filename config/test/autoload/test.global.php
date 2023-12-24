<?php

declare(strict_types=1);

use Laminas\Router\Annotations\Test\Functional\Demo\Controller\DemoController;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            DemoController::class => InvokableFactory::class,
        ],
    ],
    'router'      => [
        'routes' => [
            'home' => [
                'type'    => Laminas\Router\Http\Literal::class,
                'options' => [
                    'route'    => '/demo',
                    'defaults' => [
                        'controller' => DemoController::class,
                        'action'     => 'demo',
                    ],
                ],
            ],
            // additional routes
        ],
    ],
];
