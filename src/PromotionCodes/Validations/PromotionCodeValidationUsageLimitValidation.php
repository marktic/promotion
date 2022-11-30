<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Validations;

use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\I18n\TranslatableMessage;

class PromotionCodeValidationUsageLimitValidation implements PromotionCodeValidation
{
    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): ValidationResult {
        $usageLimit = $promotionCoupon->getUsageLimit();

        if (null !== $usageLimit && $promotionCoupon->getUsed() >= $usageLimit) {
            return ValidationResult::invalid(
                TranslatableMessage::create('mkt_promotion_codes.messages.form.register.bad-count')
            );
        }

        return ValidationResult::valid();
    }
}
