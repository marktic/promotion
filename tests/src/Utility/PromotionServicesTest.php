<?php

namespace Marktic\Promotion\Tests\Utility;

use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Utility\PromotionServices;

class PromotionServicesTest extends AbstractTest
{
    public function test_actionCommands_singleton()
    {
        $this->loadServiceProvider();

        $service = PromotionServices::actionCommands();
        self::assertSame($service, PromotionServices::actionCommands());
    }
}