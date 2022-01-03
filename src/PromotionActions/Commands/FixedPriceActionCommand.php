<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Base\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class FixedPriceActionCommand extends DiscountActionCommand
{
    public const NAME = 'fixed_price';

    public function execute(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): bool {
        // TODO: Implement execute() method.
    }

    public function revert(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): void {
        // TODO: Implement revert() method.
    }

    protected function describeConfigurationValue($label, $value, $prefix = '=', $suffix = null)
    {
        return parent::describeConfigurationValue($label, $value, $prefix, $suffix);
    }
}