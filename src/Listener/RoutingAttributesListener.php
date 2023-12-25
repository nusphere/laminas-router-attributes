<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\EventManager\ListenerAggregateTrait;
use Laminas\Http\Request;
use Laminas\Mvc\MvcEvent;
use Laminas\Router\Attributes\Loader\AttributesClassLoader;
use Laminas\Router\RouteMatch;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

use function array_keys;

class RoutingAttributesListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function onNoLaminasRouteFound(MvcEvent $event): ?RouteMatch
    {
        if ($event->propagationIsStopped()) {
            return null;
        }

        /** @var Request $request */
        $request       = $event->getRequest();
        $configuration = $event->getApplication()->getServiceManager()->get('config');

        $controllerSettings = $configuration['controllers']['factories'];

        $classLoader     = new AttributesClassLoader();
        $routeCollection = new RouteCollection();

        foreach (array_keys($controllerSettings) as $controller) {
            $routeCollection->addCollection($classLoader->load($controller));
        }

        $context    = new RequestContext();
        $urlMatcher = new UrlMatcher($routeCollection, $context);

        try {
            $match = $urlMatcher->match($request->getRequestUri());

            $routeMatch = new RouteMatch($match);
            $routeMatch->setMatchedRouteName($match['_route']);

            $event->setRouteMatch($routeMatch);
            $event->stopPropagation();
            $event->setError(null);

            return $routeMatch;
        } catch (ResourceNotFoundException) {
            return null;
        }
    }

    /**
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1): void
    {
        $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            fn (MvcEvent $event) => self::onNoLaminasRouteFound($event),
            9999
        );
    }
}
