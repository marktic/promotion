<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class FixedDiscountActionCommand extends DiscountActionCommand
{
    public const NAME = 'fixed_discount';

    protected function describeConfigurationValue($label, $value, $prefix = '-', $suffix = null): string
    {
        return parent::describeConfigurationValue($label, $value, $prefix, $suffix);
    }
}