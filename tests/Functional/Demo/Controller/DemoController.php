<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Test\Functional\Demo\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Symfony\Component\Routing\Attribute\Route;

final class DemoController extends AbstractActionController
{
    #[Route(path: 'demo', name: 'demo-route')]
    public function demoAction(): Response
    {
        $response = new Response();
        $response->setContent('<b>This is a demo controller</b>');

        return $response;
    }

    #[Route(path: '/path/sub', name: 'post-route', methods: ['POST'])]
    public function postDemoAction(): Response
    {
        $post = $this->getRequest()->getPost('test');

        $response = new Response();
        $response->setContent('You POST: ' . $post);

        return $response;
    }
}
