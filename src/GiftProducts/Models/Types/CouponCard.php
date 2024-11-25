<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models\Types;

class CouponCard extends AbstractType
{
    public const NAME = 'coupon_card';

    public function getColorClass(): string
    {
        return 'success';
    }
}
