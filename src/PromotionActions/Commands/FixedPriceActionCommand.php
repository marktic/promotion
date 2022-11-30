<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Commands;

class FixedPriceActionCommand extends DiscountActionCommand
{
    public const NAME = 'fixed_price';

    protected function describeConfigurationValue($label, $value, $prefix = '=', $suffix = null): string
    {
        return parent::describeConfigurationValue($label, $value, $prefix, $suffix);
    }
}
