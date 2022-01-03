<?php

namespace Marktic\Promotion\PromotionActions\Commands;

abstract class DiscountActionCommand implements PromotionActionCommandInterface
{
    public const NAME = '';

    public function getName()
    {
        return static::NAME;
    }
}