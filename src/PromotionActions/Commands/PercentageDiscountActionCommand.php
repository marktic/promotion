<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Commands;

class PercentageDiscountActionCommand extends DiscountActionCommand
{
    public const NAME = 'percentage_discount';

    protected function describeConfigurationValue($label, $value, $prefix = '-', $suffix = '%'): string
    {
        return parent::describeConfigurationValue($label, $value, $prefix, $suffix);
    }
}
