<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Validations;

use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ValidatePromotionExclusivity implements ValidatesPromotion
{
    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        if (false === $promotion->isExclusive()) {
            return ValidationResult::valid();
        }
        $promotions = $promotionSubject->getPromotions();
        if (\count($promotions) > 0) {
            return ValidationResult::invalid(
                'Only one promotion can be active at a time'
            );
        }

        return ValidationResult::valid();
    }
}
