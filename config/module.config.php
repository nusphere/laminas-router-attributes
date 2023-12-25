<?php

declare(strict_types=1);

use Laminas\Router\Attributes\Listener\RoutingAttributesListener;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'listeners'       => [
        RoutingAttributesListener::class,
    ],
    'service_manager' => [
        'factories' => [
            RoutingAttributesListener::class => InvokableFactory::class,
        ],
    ],
];
