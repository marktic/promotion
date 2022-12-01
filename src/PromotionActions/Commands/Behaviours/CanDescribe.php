<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Commands\Behaviours;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;

trait CanDescribe
{
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

        return implode(' | ', $return);
    }

    /**
     * @psalm-param 'Base' $label
     */
    protected function describeConfigurationValue(string $label, $value, $prefix = '', $suffix = ''): string
    {
        return $label . ': ' . $prefix . $value . $suffix;
    }

}
