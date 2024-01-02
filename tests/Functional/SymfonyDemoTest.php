<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Test\Functional;

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

    public function testRequirements(): void
    {
        $this->dispatch('/symfony/blog/2');

        self::assertSame('list(2)', $this->getResponse()->getContent());
    }

    public function testRequirementsSecondVersion(): void
    {
        $this->dispatch('/symfony/blogs/44');

        self::assertSame('listSecond(44)', $this->getResponse()->getContent());
    }

    public function testRequirementsAlternatives(): void
    {
        $this->dispatch('/symfony/blog/entry-name');

        self::assertSame('show(entry-name)', $this->getResponse()->getContent());
    }

    public function testDefaultFunctionality(): void
    {
        $this->dispatch('/symfony/default');

        self::assertSame('showDefaultAction(text)', $this->getResponse()->getContent());
    }

    public function testDefaultAttributeFunctionality(): void
    {
        $this->dispatch('/symfony/default2');

        self::assertSame('showDefaultWithAttributeAction(test2)', $this->getResponse()->getContent());
    }

    public function testDefaultFunctionalityTestNormal(): void
    {
        $this->dispatch('/symfony/default/non-default');

        self::assertSame('showDefaultAction(non-default)', $this->getResponse()->getContent());
    }
}
