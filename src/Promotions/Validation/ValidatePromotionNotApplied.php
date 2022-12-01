<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Validation;

use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ValidatePromotionNotApplied implements ValidatesPromotion
{
    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        $promotionSessions = $promotionSubject->getPromotionSessions();

        foreach ($promotionSessions as $promotionSession) {
            if ($promotionSession->getPromotionId() === $promotion->getId()) {
                return ValidationResult::invalid(
                    'Promotion already applied to this subject'
                );
            }
        }

        return ValidationResult::valid();
    }
}
