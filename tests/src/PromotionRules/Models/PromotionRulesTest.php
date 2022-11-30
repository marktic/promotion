<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionRules\Models;

use Marktic\Promotion\PromotionRules\Models\PromotionRules;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionRulesTest extends AbstractRepositoryTest
{
    public function testGetController(): void
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_rules', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionRules::class;
    }
}
