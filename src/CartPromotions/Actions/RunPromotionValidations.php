<?php

namespace Marktic\Promotion\CartPromotions\Actions;

use Marktic\Promotion\Base\Validations\PromotionValidation;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionRules\Validations\PromotionRulesValidation;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class RunPromotionValidations
{
    protected ?PromotionValidation $promotionValidation;

    /**
     * @param PromotionValidation|null $promotionValidation
     */
    public function __construct(?PromotionValidation $promotionValidation = null)
    {
        $this->promotionValidation = $promotionValidation ?? new PromotionRulesValidation();
    }

    public function execute(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        return $this->promotionValidation->validate($promotionSubject, $promotion);
    }
}
