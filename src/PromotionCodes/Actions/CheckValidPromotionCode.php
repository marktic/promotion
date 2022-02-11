<?php

namespace Marktic\Promotion\PromotionCodes\Actions;

use Bytic\Assert\Assert;
use Marktic\Promotion\Checker\Eligibility\Codes\CompositePromotionCouponEligibilityChecker;
use Marktic\Promotion\Checker\Eligibility\Codes\PromotionCodeDurationLimitEligibilityChecker;
use Marktic\Promotion\Checker\Eligibility\Codes\PromotionCodeUsageLimitEligibilityChecker;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PromotionModels;

class CheckValidPromotionCode
{
    /**
     * @var PromotionCodes
     */
    protected $promotionCodeRepository;

    public function __construct($promotionCodeRepository = null)
    {
        $this->promotionCodeRepository = $promotionCodeRepository ?? PromotionModels::promotionCodes();
    }

    public static function for(PromotionSubjectInterface $subject, string $promotionCode): ?PromotionCodeInterface
    {
        return (new self())->execute($subject, $promotionCode);
    }

    public function execute(PromotionSubjectInterface $subject, string $promotionCode): ?PromotionCodeInterface
    {
        $promotionCode = $this->findPromotionCode($promotionCode);
        $this->validatePromotionCode($subject, $promotionCode);

        return $promotionCode;
    }

    protected function findPromotionCode($promotionCode)
    {
        $promotionCode = $this->promotionCodeRepository->findOneByCode($promotionCode);
        Assert::that($promotionCode)
            ->isObject()
            ->orFail('Promotion code not found')->orThrow(InvalidPromotionalCode::class);

        return $promotionCode;
    }

    protected function validatePromotionCode(PromotionSubjectInterface $subject, PromotionCodeInterface $promotionCode)
    {
        $checker = $this->buildEligibilityChecker();
        Assert::that($checker->isEligible($subject, $promotionCode))
            ->isTrue()
            ->orFail('Promotion code not eligible')->orThrow(InvalidPromotionalCode::class);
    }

    protected function buildEligibilityChecker(): CompositePromotionCouponEligibilityChecker
    {
        return new CompositePromotionCouponEligibilityChecker([
            new PromotionCodeDurationLimitEligibilityChecker(),
            new PromotionCodeUsageLimitEligibilityChecker(),
        ]);
    }
}
