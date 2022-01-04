<?php

namespace Marktic\Promotion\Tests\PromotionRules\Models;

use Marktic\Promotion\PromotionRules\Models\PromotionRules;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionRulesTest extends AbstractRepositoryTest
{

    public function test_getController()
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_rules', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionRules::class;
    }
}
