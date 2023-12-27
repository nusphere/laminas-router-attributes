<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Test\Functional\Demo\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/symfony')]
final class SymfonyDemoController extends AbstractActionController
{
    #[Route(
        '/contact',
        name: 'contact',
        condition: "context.getMethod() in ['GET', 'HEAD']",
        // todo - and request.headers.get('User-Agent') matches '/firefox/i'
    )]
    public function contactAction(): Response
    {
        $response = new Response();
        $response->setContent('<b>This is a symfony condition demo</b>');

        return $response;
    }

    #[Route(
        '/posts/{id}',
        name: 'post_show',
        // expressions can retrieve route parameter values using the "params" variable
        condition: "params['id'] < 1000"
    )]
    public function showPostAction(): Response
    {
        $id = $this->getEvent()->getRouteMatch()?->getParam('id');

        $response = new Response();
        $response->setContent('showPostAction(' . $id . ')');

        return $response;
    }

    #[Route('/blog/{page}', name: 'blog_list', requirements: ['page' => '\d+'])]
    public function listAction(): Response
    {
        $page = $this->getEvent()->getRouteMatch()?->getParam('page');

        $response = new Response();
        $response->setContent('list(' . $page . ')');

        return $response;
    }

    #[Route('/blogs/{page<\d+>}', name: 'blog_list_second')]
    public function listSecondAction(): Response
    {
        $page = $this->getEvent()->getRouteMatch()?->getParam('page');

        $response = new Response();
        $response->setContent('listSecond(' . $page . ')');

        return $response;
    }

    #[Route('/blog/{slug}', name: 'blog_show')]
    public function showAction(): Response
    {
        $slug = $this->getEvent()->getRouteMatch()?->getParam('slug');

        $response = new Response();
        $response->setContent('show(' . $slug . ')');

        return $response;
    }

    #[Route('/default/{urlvar?text}', name: 'default-route')]
    public function showDefaultAction(): Response
    {
        $urlVar = $this->getEvent()->getRouteMatch()?->getParam('urlvar');

        $response = new Response();
        $response->setContent('showDefaultAction(' . $urlVar . ')');

        return $response;
    }

    #[Route('/default2/{urlvar?}', name: 'default-route-attributes', defaults: ['urlvar' => 'test2'])]
    public function showDefaultWithAttributeAction(): Response
    {
        $urlVar = $this->getEvent()->getRouteMatch()?->getParam('urlvar');

        $response = new Response();
        $response->setContent('showDefaultWithAttributeAction(' . $urlVar . ')');

        return $response;
    }
}
