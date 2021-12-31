<?php

namespace Marktic\Promotion\PromotionActions\DataObjects;

use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Commands\FixedPriceActionCommand;
use Marktic\Promotion\PromotionActions\Commands\PercentageDiscountActionCommand;

class PromotionActionType
{
    protected static array $classes = [
        FixedDiscountActionCommand::NAME => FixedDiscountActionCommand::class,
        FixedPriceActionCommand::NAME => FixedPriceActionCommand::class,
        PercentageDiscountActionCommand::NAME => PercentageDiscountActionCommand::class,
    ];

    public static function classes(): array
    {
        return self::$classes;
    }
}