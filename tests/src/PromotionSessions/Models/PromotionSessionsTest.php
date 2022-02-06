<?php

namespace Marktic\Promotion\Tests\PromotionSessions\Models;

use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionSessionsTest extends AbstractRepositoryTest
{

    public function test_getController()
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_sessions', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionSessions::class;
    }
}
