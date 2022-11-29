<?php

namespace Marktic\Promotion\Tests\CartPromotions\Models;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\CartPromotions\Models\Types\Automatic;
use Marktic\Promotion\CartPromotions\Models\Types\CouponCode;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class CartPromotionsTest extends AbstractRepositoryTest
{

    public function test_getTypes()
    {
        $repository = new CartPromotions();
        $types = $repository->getTypes();
        self::assertCount(2, $types);
        self::assertInstanceOf(Automatic::class, $types['automatic']);
        self::assertInstanceOf(CouponCode::class, $types['coupon_code']);
    }

    protected function getRepositoryClass(): string
    {
        return CartPromotions::class;
    }
}
