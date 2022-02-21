<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class PercentageDiscountActionCommand extends DiscountActionCommand
{
    public const NAME = 'percentage_discount';


    public function revert(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): void {
        // TODO: Implement revert() method.
    }

    protected function describeConfigurationValue($label, $value, $prefix = '-', $suffix = '%'): string
    {
        return parent::describeConfigurationValue($label, $value, $prefix, $suffix);
    }

    protected function createPriceAdjustment(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ) {
        $adjustment = parent::createPriceAdjustment($subject, $configuration, $promotion);
        $adjustment->modifiesPercentage();
        return $adjustment;
    }
}