<?php

namespace Marktic\Promotion\PromotionSubjects\Actions\PromotionCodes;

use Marktic\Promotion\CartPromotions\Actions\RunPromotionValidations;
use Marktic\Promotion\PromotionCodes\Actions\FindAndValidatePromotionCode;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Actions\ApplyPromotion;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class RedeemPromotionCode
{
    protected ?FindAndValidatePromotionCode $promotionCodeValidator;
    protected RunPromotionValidations $promotionValidator;
    protected ApplyPromotion $promotionApplicator;

    public function __construct(
        ?FindAndValidatePromotionCode $promotionCodeValidator = null,
        ?RunPromotionValidations $promotionValidator = null,
        ?ApplyPromotion $promotionApplicator = null
    ) {
        $this->promotionCodeValidator = $promotionCodeValidator ?? new FindAndValidatePromotionCode();
        $this->promotionValidator = $promotionValidator ?? new RunPromotionValidations();
        $this->promotionApplicator = $promotionApplicator ?? new ApplyPromotion();
    }

    /**
     * @throws InvalidPromotionalCode
     */
    public function for(PromotionSubjectInterface $promotionSubject, string $code): void
    {
        $promotionCode = $this->validatePromotionCode($promotionSubject, $code);
        $promotion = $promotionCode->getPromotion();

        $this->validatePromotion($promotionSubject, $promotion);
        $this->applyPromotion($promotionSubject, $promotion);
    }

    /**
     * @throws InvalidPromotionalCode
     */
    protected function validatePromotionCode(
        PromotionSubjectInterface $promotionSubject,
        string $code
    ): ?PromotionCodeInterface {
        return $this->promotionCodeValidator->execute($promotionSubject, $code);
    }

    /**
     * @throws InvalidPromotionalCode
     */
    protected function validatePromotion(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): void {
        $result = $this->promotionValidator->execute($promotionSubject, $promotion);
        if ($result->isInvalid()) {
            throw new InvalidPromotionalCode($result->message());
        }
    }

    protected function applyPromotion(PromotionSubjectInterface $promotionSubject, ?PromotionInterface $promotion)
    {
        $this->promotionApplicator->apply($promotionSubject, $promotion);
    }
}