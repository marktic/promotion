<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility\Codes;

use Marktic\Promotion\Checker\Eligibility\EligibilityResponse;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface PromotionCodeEligibilityCheckerInterface
{
    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): EligibilityResponse;
}
