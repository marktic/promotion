<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Validations;

use DateTime;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\I18n\TranslatableMessage;

class PromotionCodeDurationLimitValidation implements PromotionCodeValidationInterface
{
    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): ValidationResult {
        $now = new DateTime();
        $from = $promotionCoupon->getValidFrom();
        if ($from && $now < $from) {
            return $this->invalidResponse();
        }

        $to = $promotionCoupon->getValidTo();
        if ($to && $to < $now) {
            return $this->invalidResponse();
        }
        return ValidationResult::valid();
    }

    protected function invalidResponse(): ValidationResult
    {
        return ValidationResult::invalid(
            TranslatableMessage::create('mkt_promotion_codes.messages.form.register.bad-date')
        );
    }
}