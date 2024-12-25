<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests;

use Exception;
use InvalidArgumentException;
use ArrayAccess;
use Bytic\Phpqa\PHPUnit\TestCase;
use Marktic\Promotion\PromotionServiceProvider;
use PHPUnit\Framework\Assert as PhpUnitAssert;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\InvalidArgumentException as PHPUnitInvalidArgumentException;
use Nip\Config\Config;
use Nip\Container\Utility\Container;

/**
 * Class AbstractTest.
 */
abstract class AbstractTest extends TestCase
{
    protected function loadConfig($data = []): void
    {
        $config = config();
        $configNew = new Config(['mkt_promotion' => $data], true);
        Container::container()->set('config', $config->merge($configNew));
    }

    protected function loadConfigFromFixture(string $name): void
    {
        $config = require TEST_FIXTURE_PATH . '/config/' . $name . '.php';
        $this->loadConfig($config);
    }

    protected function loadServiceProvider(): PromotionServiceProvider
    {
        $container = Container::container();
        $provider = new PromotionServiceProvider();
        $provider->setContainer($container);
        $provider->register();

        return $provider;
    }

    protected function loadFakeTranslator(): void
    {
        $translator = \Mockery::mock('translator');
        $translator->shouldReceive('trans')->andReturnArg(0);

        $container = Container::container();
        $container->set('translator', $translator);
    }

    protected static function assertArrayContainsArray($needle, $haystack): void
    {
        foreach ($needle as $key => $value) {
            self::assertArrayHasKey($key, $haystack);
            self::assertSame($value, $haystack[$key]);
        }
    }
}
