<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;

abstract class DiscountActionCommand implements PromotionActionCommandInterface
{
    public const NAME = '';

    public function getName()
    {
        return static::NAME;
    }

    public function describeConfiguration(ModelConfiguration $configuration): string
    {
        if ($configuration->hasByKey('amount')) {
            $return[] = $this->describeConfigurationValue('Base', $configuration->get('amount'));
        }
        $currencies = $configuration->get('amount_c', []);
        foreach ($currencies as $currency => $value) {
            $return[] = $this->describeConfigurationValue($currency, $value);
        }
        return implode(" | ", $return);
    }

    protected function describeConfigurationValue($label, $value, $prefix = '', $suffix = '')
    {
        return $label . ': ' . $prefix . $value . $suffix;
    }
}