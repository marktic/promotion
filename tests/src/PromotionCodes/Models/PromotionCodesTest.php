<?php

namespace Marktic\Promotion\Tests\PromotionCodes\Models;

use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionCodesTest extends AbstractRepositoryTest
{

    public function test_getController()
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_codes', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionCodes::class;
    }
}
