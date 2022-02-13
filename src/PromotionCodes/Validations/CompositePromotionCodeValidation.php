<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Validations;

use Bytic\Assert\Assert;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class CompositePromotionCodeValidation implements PromotionCodeValidationInterface
{
    /** @var PromotionCodeValidationInterface[] */
    private array $eligibilityCheckers;

    /**
     * @param PromotionCodeValidationInterface[] $promotionCouponEligibilityCheckers
     */
    public function __construct(array $promotionCouponEligibilityCheckers)
    {
        Assert::notEmpty($promotionCouponEligibilityCheckers);
        Assert::allIsInstanceOf($promotionCouponEligibilityCheckers, PromotionCodeValidationInterface::class);

        $this->eligibilityCheckers = $promotionCouponEligibilityCheckers;
    }

    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): ValidationResult {
        foreach ($this->eligibilityCheckers as $promotionCouponEligibilityChecker) {
            $response = $promotionCouponEligibilityChecker->isEligible($promotionSubject, $promotionCoupon);
            if ($response->isInvalid()) {
                return $response;
            }
        }

        return ValidationResult::valid();
    }
}