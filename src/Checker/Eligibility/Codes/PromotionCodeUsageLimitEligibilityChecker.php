<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility\Codes;

use Marktic\Promotion\Checker\Eligibility\EligibilityResponse;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class PromotionCodeUsageLimitEligibilityChecker implements PromotionCodeEligibilityCheckerInterface
{
    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): EligibilityResponse {
        $usageLimit = $promotionCoupon->getUsageLimit();

        if ($usageLimit !== null || $promotionCoupon->getUsed() > $usageLimit) {
            return EligibilityResponse::invalid('Promotion code usage limit reached');
        }

        return EligibilityResponse::valid();
    }
}