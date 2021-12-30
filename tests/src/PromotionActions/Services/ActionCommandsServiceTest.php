<?php

namespace Marktic\Promotion\Tests\PromotionActions\Services;

use Marktic\Promotion\PromotionActions\Commands\FixedPriceActionCommand;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\Tests\AbstractTest;

class ActionCommandsServiceTest extends AbstractTest
{
    public function test_all()
    {
        $service = new ActionCommandsService();
        $commands = $service->all();

        self::assertCount(3, $commands);
        self::assertInstanceOf(FixedPriceActionCommand::class, $commands[FixedPriceActionCommand::NAME]);
    }
}