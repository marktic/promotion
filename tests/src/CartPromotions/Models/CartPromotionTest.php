<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\CartPromotions\Models;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasPool\RecordHasPoolTestTrait;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasValidity\RecordHasValidityTestTrait;

class CartPromotionTest extends AbstractRecordTest
{
    use RecordHasValidityTestTrait;
    use RecordHasPoolTestTrait;

    public function testGetType(): void
    {
        $record = new CartPromotion();
        $record->type = 'automatic';
        $this->assertEquals('automatic', $record->getType());
    }

    protected function getRecordClass(): string
    {
        return CartPromotion::class;
    }
}
