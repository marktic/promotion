<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class PercentageDiscountActionCommand extends DiscountActionCommand
{
    public const NAME = 'percentage_discount';

    protected function describeConfigurationValue($label, $value, $prefix = '-', $suffix = '%'): string
    {
        return parent::describeConfigurationValue($label, $value, $prefix, $suffix);
    }

}
