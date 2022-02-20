<?php

namespace Marktic\Promotion\PromotionActions\Commands;

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
                'trigger_type' => $promotion->getManager()->getMorphName(),
                'trigger_id' => $promotion->getId(),
                'trigger_code' => $promotion->getCode(),
            ]
        )
            ->withSaleable($subject)
            ->get();
        $adjustment->setPropertyValue('value', $configuration['amount'] ?? null);
        $adjustment->getConfiguration()->set('amount_c', $configuration['amount_c'] ?? []);
        return $adjustment;
    }

    protected function describeConfigurationValue($label, $value, $prefix = '', $suffix = ''): string
    {
        return $label . ': ' . $prefix . $value . $suffix;
    }
}