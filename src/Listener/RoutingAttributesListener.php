<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\EventManager\ListenerAggregateTrait;
use Laminas\ModuleManager\ModuleEvent;

class RoutingAttributesListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    public function onMergeConfig(ModuleEvent $event): void
    {
    }

    /**
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1): void
    {
        $events->attach(
            ModuleEvent::EVENT_MERGE_CONFIG,
            function (ModuleEvent $e): void {
                self::onMergeConfig($e);
            },
            $priority
        );
    }
}
