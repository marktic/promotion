<?php

namespace Marktic\Promotion\CartPromotions\Models\Types;

class CouponCode extends AbstractType
{
    public const NAME = 'coupon_code';

    public function getColorClass(): string
    {
        return 'primary';
    }
}