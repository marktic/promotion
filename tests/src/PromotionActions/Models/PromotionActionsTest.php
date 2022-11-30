<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionActions\Models;

use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionActionsTest extends AbstractRepositoryTest
{
    public function testGetController()
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_actions', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionActions::class;
    }
}
