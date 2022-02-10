<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility\Codes;

use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class PromotionCodeUsageLimitEligibilityChecker implements PromotionCodeEligibilityCheckerInterface
{
    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): bool {
        $usageLimit = $promotionCoupon->getUsageLimit();

        return $usageLimit === null || $promotionCoupon->getUsed() < $usageLimit;
    }
}