<?php

namespace Laminas\Router\Attributes\Test\Functional\Demo\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/symfony')]
class SymfonyDemoController extends AbstractActionController
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

}