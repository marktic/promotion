<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Pricing\PriceAdjustments\Contracts\PriceAdjustment as PriceAdjustmentContract;
use Marktic\Pricing\PriceAdjustments\Factories\PriceAdjustmentFactory;
use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

abstract class DiscountActionCommand implements PromotionActionCommandInterface
{
    public const NAME = '';

    public function getName()
    {
        return static::NAME;
    }

    public function execute(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): bool {
        $adjustment = $this->createPriceAdjustment($subject, $configuration, $promotion);
        $adjustment->save();
        return true;
    }

    public function revert(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): void {
        // TODO: Implement revert() method.
    }


    public function describeConfiguration(ModelConfiguration $configuration): string
    {
        $return = [];
        if ($configuration->hasByKey('amount')) {
            $return[] = $this->describeConfigurationValue('Base', $configuration->get('amount'));
        }
        $currencies = $configuration->get('amount_c', []);
        foreach ($currencies as $currency => $value) {
            $return[] = $this->describeConfigurationValue($currency, $value);
        }
        return implode(" | ", $return);
    }

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

    protected function describeConfigurationValue($label, $value, $prefix = '', $suffix = ''): string
    {
        return $label . ': ' . $prefix . $value . $suffix;
    }

    protected function getPriceAdjustmentModification(): string
    {
        switch (static::NAME) {
            case PercentageDiscountActionCommand::NAME:
                return PriceAdjustmentContract::MODIFICATION_PERCENTAGE;
            case FixedDiscountActionCommand::NAME:
                return PriceAdjustmentContract::MODIFICATION_FIXED;
            case FixedPriceActionCommand::NAME:
                return PriceAdjustmentContract::MODIFICATION_AMOUNT;
            default:
                throw new \Exception('Unknown discount type');
        }
    }
}