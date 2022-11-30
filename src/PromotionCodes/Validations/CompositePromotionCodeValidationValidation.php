<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Validations;

use Bytic\Assert\Assert;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class CompositePromotionCodeValidationValidation implements PromotionCodeValidation
{
    /** @var PromotionCodeValidation[] */
    private array $eligibilityCheckers;

    /**
     * @param PromotionCodeValidation[] $promotionCouponEligibilityCheckers
     */
    public function __construct(array $promotionCouponEligibilityCheckers)
    {
        Assert::notEmpty($promotionCouponEligibilityCheckers);
        Assert::allIsInstanceOf($promotionCouponEligibilityCheckers, PromotionCodeValidation::class);

        $this->eligibilityCheckers = $promotionCouponEligibilityCheckers;
    }

    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): ValidationResult {
        foreach ($this->eligibilityCheckers as $promotionCouponEligibilityChecker) {
            $response = $promotionCouponEligibilityChecker->validate($promotionSubject, $promotionCoupon);
            if ($response->isInvalid()) {
                return $response;
            }
        }

        return ValidationResult::valid();
    }
}
