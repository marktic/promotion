<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility\Codes;

use Bytic\Assert\Assert;
use Marktic\Promotion\Checker\Eligibility\EligibilityResponse;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class CompositePromotionCouponEligibilityChecker implements PromotionCodeEligibilityCheckerInterface
{
    /** @var PromotionCodeEligibilityCheckerInterface[] */
    private array $eligibilityCheckers;

    /**
     * @param PromotionCodeEligibilityCheckerInterface[] $promotionCouponEligibilityCheckers
     */
    public function __construct(array $promotionCouponEligibilityCheckers)
    {
        Assert::notEmpty($promotionCouponEligibilityCheckers);
        Assert::allIsInstanceOf($promotionCouponEligibilityCheckers, PromotionCodeEligibilityCheckerInterface::class);

        $this->eligibilityCheckers = $promotionCouponEligibilityCheckers;
    }

    public function isEligible(
        PromotionSubjectInterface $promotionSubject,
        PromotionCodeInterface $promotionCoupon
    ): EligibilityResponse {
        foreach ($this->eligibilityCheckers as $promotionCouponEligibilityChecker) {
            $response = $promotionCouponEligibilityChecker->isEligible($promotionSubject, $promotionCoupon);
            if ($response->isInvalid()) {
                return $response;
            }
        }

        return EligibilityResponse::valid();
    }
}