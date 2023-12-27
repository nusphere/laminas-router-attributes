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
}
