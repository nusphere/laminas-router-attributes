<?php

declare(strict_types=1);

namespace Laminas\Router\Attributes\Test\Functional;

use Exception;
use Laminas\Http\Headers;
use Laminas\Http\Request;
use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;
use Laminas\View\Exception\RuntimeException;

use function dirname;

final class SymfonyDemoTest extends AbstractControllerTestCase
{
    protected function setUp(): void
    {
        $this->setApplicationConfig(include dirname(__DIR__, 2) . '/config/test/application.global.php');
    }

    /**
     * @throws Exception
     */
    public function testConditionalRoutes(): void
    {
        // This is hard to test
        header('User-Agent: Firefox');

        $this->dispatch('/symfony/contact');

        self::assertSame('<b>This is a symfony condition demo</b>', $this->getResponse()->getContent());
    }
}
