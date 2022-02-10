<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility\Codes;

use DateTime;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class PromotionCodeDurationLimitEligibilityChecker implements PromotionCodeEligibilityCheckerInterface
{
    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): bool {
        $now = new DateTime();
        $from = $promotionCoupon->getValidFrom();
        if ($from && $now < $from) {
            return false;
        }

        $to = $promotionCoupon->getValidTo();
        if ($to && $to < $now) {
            return false;
        }
        return true;
    }
}