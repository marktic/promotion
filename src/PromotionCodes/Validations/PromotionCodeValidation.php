<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Validations;

use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface PromotionCodeValidation
{
    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): ValidationResult;
}
