<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Test\Functional;

use Exception;
use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;
use Laminas\View\Exception\RuntimeException;

use function dirname;

final class DemoTest extends AbstractControllerTestCase
{
    protected function setUp(): void
    {
        $this->setApplicationConfig(include dirname(__DIR__, 2) . '/config/test/application.global.php');
    }

    /**
     * @throws Exception
     */
    public function testFindingRoutes(): void
    {
        $this->dispatch('/demo');

        self::assertSame('<b>This is a demo controller</b>', $this->getResponse()->getContent());
    }

    /**
     * @throws Exception
     */
    public function testGETtoPOSTRouteWillFail(): void
    {
        $this->expectException(RuntimeException::class);

        $this->dispatch('/path/sub');
    }

    public function testPOSTtoPOSTRouteWillSuccess(): void
    {
        $this->dispatch('/path/sub', 'POST', ['test' => 'posted var']);

        self::assertSame('You POST: posted var', $this->getResponse()->getContent());
    }
}
