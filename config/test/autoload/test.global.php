<?php

use Laminas\Router\Annotations\Test\Functional\Demo\Controller\DemoController;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            DemoController::class => InvokableFactory::class,
        ],
    ],
];
