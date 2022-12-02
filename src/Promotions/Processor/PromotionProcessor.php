<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Processor;

use Marktic\Promotion\CartPromotions\Actions\RunPromotionValidations;
use Marktic\Promotion\CartPromotions\Models\Types\Automatic;
use Marktic\Promotion\Promotions\Applicator\PromotionApplicator;
use Marktic\Promotion\Promotions\Provider\PreQualifiedPromotionsProviderInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class PromotionProcessor
{
    protected PreQualifiedPromotionsProviderInterface $promotionProvider;
    protected PromotionApplicator $applicator;
    protected RunPromotionValidations $promotionValidator;

    public function __construct(
        PreQualifiedPromotionsProviderInterface $promotionProvider,
        ?PromotionApplicator $applicator = null,
        ?RunPromotionValidations $promotionValidator = null,
    ) {
        $this->promotionProvider = $promotionProvider;
        $this->applicator = $applicator ?? new PromotionApplicator();
        $this->promotionValidator = $promotionValidator ?? new RunPromotionValidations();
    }

    public function process(PromotionSubjectInterface $subject): void
    {
        foreach ($subject->getPromotions() as $promotion) {
            if (Automatic::NAME !== $promotion->getType()) {
                continue;
            }
            $this->applicator->revertFor($subject, $promotion);
        }
        $preQualifiedPromotions = $this->promotionProvider->getPromotionsFor($subject);

        foreach ($preQualifiedPromotions as $promotion) {
            if ($promotion->isExclusive()
                && $this->promotionValidator->isEligible($subject, $promotion)) {
                $this->applicator->applyFor($subject, $promotion);

                return;
            }
        }

        foreach ($preQualifiedPromotions as $promotion) {
            if (false === $promotion->isExclusive() && $this->promotionValidator->isEligible($subject, $promotion)) {
                $this->applicator->applyFor($subject, $promotion);
            }
        }
    }
}
