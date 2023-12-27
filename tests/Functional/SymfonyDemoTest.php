<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Test\Functional;

use Exception;
use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;

use Laminas\View\Exception\RuntimeException;
use function dirname;
use function header;

final class SymfonyDemoTest extends AbstractControllerTestCase
{
    protected function setUp(): void
    {
        $this->setApplicationConfig(include dirname(__DIR__, 2) . '/config/test/application.global.php');
    }

    public function testConditionalRoutes(): void
    {
        // This is hard to test
        header('User-Agent: Firefox');

        $this->dispatch('/symfony/contact');

        self::assertSame('<b>This is a symfony condition demo</b>', $this->getResponse()->getContent());
    }

    public function testConditionalRouteWithParams(): void
    {
        $this->dispatch('/symfony/posts/12');

        self::assertSame('showPostAction(12)', $this->getResponse()->getContent());
    }

    public function testConditionalRouteWithParamsFailed(): void
    {
        $this->expectException(RuntimeException::class);

        // use an id above 1000 -> see condition in SymfonyDemoController::showPostAction
        $this->dispatch('/symfony/posts/1200');
    }
}
