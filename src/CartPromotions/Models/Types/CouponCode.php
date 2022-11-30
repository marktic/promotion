<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models\Types;

class CouponCode extends AbstractType
{
    public const NAME = 'coupon_code';

    public function getColorClass(): string
    {
        return 'primary';
    }
}
