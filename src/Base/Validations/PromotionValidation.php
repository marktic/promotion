<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Validations;

use Marktic\Promotion\Base\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface PromotionValidation
{

    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult;
}