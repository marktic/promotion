<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Configurations;

use ByTIC\DataObjects\Casts\Metadata\Metadata;
use Marktic\Promotion\Utility\PackageConfig;

/**
 * Class ModelConfiguration.
 */
class ModelConfiguration extends Metadata
{
    public function getWithCurrency($name, $currency = null, $default = null)
    {
        $default = $this->get($name, $default);

        return $this->get($this->encodeCurrencyKey($name, $currency), $default);
    }

    public function setWithCurrency($name, $value, $currency = null)
    {
        $this->set($this->encodeCurrencyKey($name, $currency), $value);
    }

    /**
     * @param string|object $currencyCode
     */
    public function checkCurrencyCode($currencyCode): string
    {
        if (\is_object($currencyCode)) {
            return $currencyCode->code;
        } elseif (\is_string($currencyCode)) {
            return $currencyCode;
        }

        return PackageConfig::defaultCurrencyCode('EUR');
    }

    protected function encodeCurrencyKey($name, $currency)
    {
        return $name . '_c.' . $currency;
    }
}
