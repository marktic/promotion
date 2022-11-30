<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Utility;

use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionFactory;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Utility\PromotionFactories;
use Nip\Records\Locator\ModelLocator;

class PromotionFactoriesTest extends AbstractTest
{
    public function testItCreatesPromotionFactory()
    {
        $this->loadServiceProvider();
        ModelLocator::set(\Marktic\Promotion\PromotionActions\Models\PromotionActions::class, new PromotionActions());
        ModelLocator::set(PromotionActions::class, new PromotionActions());

        $promotionFactory = PromotionFactories::actions();

        $this->assertInstanceOf(PromotionActionFactory::class, $promotionFactory);
    }
}
