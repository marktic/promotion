<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Actions\PromotionCodes;

use Marktic\Promotion\CartPromotions\Actions\RunPromotionValidations;
use Marktic\Promotion\PromotionCodes\Actions\FindAndValidatePromotionCode;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\Promotions\Applicator\DataObjects\ApplyPromotionRequest;
use Marktic\Promotion\Promotions\Applicator\PromotionApplicator;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class RedeemPromotionCode
{
    protected ?FindAndValidatePromotionCode $promotionCodeValidator;
    protected RunPromotionValidations $promotionValidator;
    protected PromotionApplicator $promotionApplicator;

    public function __construct(
        ?FindAndValidatePromotionCode $promotionCodeValidator = null,
        ?RunPromotionValidations $promotionValidator = null,
        ?PromotionApplicator $promotionApplicator = null
    ) {
        $this->promotionCodeValidator = $promotionCodeValidator ?? new FindAndValidatePromotionCode();
        $this->promotionValidator = $promotionValidator ?? new RunPromotionValidations();
        $this->promotionApplicator = $promotionApplicator ?? new PromotionApplicator();
    }

    /**
     * @throws InvalidPromotionalCode
     */
    public function for(PromotionSubjectInterface $promotionSubject, string $code): void
    {
        $promotionCode = $this->validatePromotionCode($promotionSubject, $code);
        $promotion = $promotionCode->getPromotion();

        $request = ApplyPromotionRequest::create();
        $request->setSubject($promotionSubject);
        $request->setPromotion($promotion);
        $request->setPromotionCode($promotionCode);

        $this->validatePromotion($promotionSubject, $promotion);
        $this->applyPromotion($request);
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

    protected function applyPromotion(ApplyPromotionRequest $applyPromotionRequest): void
    {
        $this->promotionApplicator->apply($applyPromotionRequest);
    }
}
