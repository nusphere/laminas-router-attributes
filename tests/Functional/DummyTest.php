<?php

namespace Laminas\Router\Annotations\Test\Functional;

use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;

final class DummyTest extends AbstractControllerTestCase
{
    public function testFindingRoutes(): void
    {
        $this->setApplicationConfig(include dirname(__DIR__, 2) . '/config/test/application.global.php');

        $this->dispatch('/demo');
        var_dump($this->getResponse());
    }
}
