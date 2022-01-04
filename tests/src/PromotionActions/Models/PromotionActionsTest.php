<?php

namespace Marktic\Promotion\Tests\PromotionActions\Models;

use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionActionsTest extends AbstractRepositoryTest
{

    public function test_getController()
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_actions', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionActions::class;
    }
}
