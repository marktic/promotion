<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Actions;

use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\CartPromotions\Validations\ValidationsFactory;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class RunPromotionValidations
{
    protected ?ValidatesPromotion $promotionValidation;

    public function __construct(?ValidatesPromotion $promotionValidation = null)
    {
        $this->promotionValidation = $promotionValidation ?? ValidationsFactory::create();
    }

    public function execute(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        return $this->promotionValidation->validate($promotionSubject, $promotion);
    }
}
