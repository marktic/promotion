<?php

namespace Marktic\Promotion\Tests\CartPromotions\Models;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasValidity\RecordHasValidityTestTrait;

class CartPromotionTest extends AbstractRecordTest
{
    use RecordHasValidityTestTrait;

    protected function getRecordClass(): string
    {
        return CartPromotion::class;
    }
}
