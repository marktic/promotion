<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Validations;

use Bytic\Assert\Assert;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class CompositeValidatePromotion implements ValidatesPromotion
{
    /* @var ValidatesPromotion[] */
    private array $promotionValidations;

    /**
     * @param ValidatesPromotion[] $promotionValidations
     */
    public function __construct(array $promotionValidations)
    {
        Assert::notEmpty($promotionValidations);
        Assert::allIsInstanceOf($promotionValidations, ValidatesPromotion::class);

        $this->promotionValidations = $promotionValidations;
    }

    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        foreach ($this->promotionValidations as $promotionValidation) {
            $response = $promotionValidation->validate($promotionSubject, $promotion);
            if ($response->isInvalid()) {
                return $response;
            }
        }

        return ValidationResult::valid();
    }
}
