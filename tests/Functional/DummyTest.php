<?php

declare(strict_types=1);

namespace Laminas\Router\Annotations\Test\Functional;

use Exception;
use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;

use function dirname;
use function var_dump;

final class DummyTest extends AbstractControllerTestCase
{
    /**
     * @throws Exception
     */
    public function testFindingRoutes(): void
    {
        $this->setApplicationConfig(include dirname(__DIR__, 2) . '/config/test/application.global.php');

        $this->dispatch('/demo');
        var_dump($this->getResponse());
    }
}
