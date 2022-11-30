<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionSessions\Models;

use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionSessionsTest extends AbstractRepositoryTest
{
    public function testGetController(): void
    {
        $repository = $this->newRepository();
        static::assertSame('mkt_promotion_sessions', $repository->getController());
    }

    protected function getRepositoryClass(): string
    {
        return PromotionSessions::class;
    }
}
