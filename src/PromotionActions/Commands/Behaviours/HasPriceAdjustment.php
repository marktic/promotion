<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Commands\Behaviours;

use Marktic\Pricing\PriceAdjustments\Contracts\PriceAdjustment as PriceAdjustmentContract;
use Marktic\Pricing\PriceAdjustments\Factories\PriceAdjustmentFactory;
use Marktic\Pricing\Utility\PricingModels;
use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Commands\FixedPriceActionCommand;
use Marktic\Promotion\PromotionActions\Commands\PercentageDiscountActionCommand;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

trait HasPriceAdjustment
{
    protected function createPriceAdjustment(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ) {
        $adjustment = PriceAdjustmentFactory::create(
            [
                'label' => $promotion->getName(),
                'currency_code' => $subject->getCurrencyCode(),
                'modification' => $this->getPriceAdjustmentModification(),
                'trigger_type' => $promotion->getManager()->getMorphName(),
                'trigger_id' => $promotion->getId(),
                'trigger_code' => $promotion->getCode(),
            ]
        )
            ->withSaleable($subject)
            ->get();
        $adjustment->setPropertyValue('value', $configuration['amount'] ?? null);
        $adjustment->getConfiguration()->set('value_c', $configuration['amount_c'] ?? []);

        return $adjustment;
    }

    protected function removePriceAdjustment(
        PromotionSubjectInterface $subject,
        PromotionInterface $promotion
    ): void {
        $repository = PricingModels::adjustments();
        $repository->deleteByParams([
            'where' => [
                ['trigger_type = ?', $promotion->getManager()->getMorphName()],
                ['trigger_id = ?', $promotion->getId()],
                ['saleable_id = ?', $subject->getId()],
                ['saleable_type = ?', $subject->getManager()->getMorphName()],
            ],
        ]);
    }


    protected function getPriceAdjustmentModification(): string
    {
        switch (static::NAME) {
            case FixedDiscountActionCommand::NAME:
                return PriceAdjustmentContract::MODIFICATION_AMOUNT;
            case FixedPriceActionCommand::NAME:
                return PriceAdjustmentContract::MODIFICATION_FIXED;
            case PercentageDiscountActionCommand::NAME:
                return PriceAdjustmentContract::MODIFICATION_PERCENTAGE;
            default:
                throw new \Exception('Unknown discount type');
        }
    }
}