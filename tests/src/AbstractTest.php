<?php

namespace Marktic\Promotion\Tests;

use Bytic\Phpqa\PHPUnit\TestCase;
use Marktic\Promotion\PromotionServiceProvider;
use Nip\Config\Config;
use Nip\Container\Utility\Container;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{

    protected function loadConfig($data = [])
    {
        $config = config();
        $configNew = new Config(['mkt_promotion' => $data], true);
        Container::container()->set('config', $config->merge($configNew));
    }

    protected function loadServiceProvider()
    {
        $container = Container::container();
        $provider = new PromotionServiceProvider();
        $provider->setContainer($container);
        $provider->register();
    }
}
