<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility\Codes;

use DateTime;
use Marktic\Promotion\Checker\Eligibility\EligibilityResponse;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\I18n\TranslatableMessage;

class PromotionCodeDurationLimitEligibilityChecker implements PromotionCodeEligibilityCheckerInterface
{
    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): EligibilityResponse {
        $now = new DateTime();
        $from = $promotionCoupon->getValidFrom();
        if ($from && $now < $from) {
            return $this->invalidResponse();
        }

        $to = $promotionCoupon->getValidTo();
        if ($to && $to < $now) {
            return $this->invalidResponse();
        }
        return EligibilityResponse::valid();
    }

    protected function invalidResponse(): EligibilityResponse
    {
        return EligibilityResponse::invalid(
            TranslatableMessage::create('mkt_promotion_codes.messages.form.register.bad-date')
        );
    }
}