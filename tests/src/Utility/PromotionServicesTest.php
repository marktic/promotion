<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Utility;

use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Utility\PromotionServices;

class PromotionServicesTest extends AbstractTest
{
    public function testActionCommandsSingleton()
    {
        $this->loadServiceProvider();

        $service = PromotionServices::actionCommands();
        self::assertSame($service, PromotionServices::actionCommands());
    }
}
