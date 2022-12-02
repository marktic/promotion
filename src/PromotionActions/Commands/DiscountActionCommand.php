<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

abstract class DiscountActionCommand implements PromotionActionCommandInterface
{
    use Behaviours\CanDescribe;
    use Behaviours\HasPriceAdjustment;

    public const NAME = '';

    public function getName()
    {
        return static::NAME;
    }

    public function execute(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): bool {
        $adjustment = $this->createPriceAdjustment($subject, $configuration, $promotion);
        $adjustment->save();

        return true;
    }

    public function revert(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): void {
        $this->removePriceAdjustment($subject, $promotion);
    }
}
