<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests;

use Bytic\Phpqa\PHPUnit\TestCase;
use Marktic\Promotion\PromotionServiceProvider;
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
}
