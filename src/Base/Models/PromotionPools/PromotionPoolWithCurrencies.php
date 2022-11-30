<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\PromotionPools;

interface PromotionPoolWithCurrencies
{
    public const CURRENCIES_METHOD = 'getPromotionPoolCurrencies';

    public function getPromotionPoolCurrencies();

    public function getPromotionPoolCurrency();
}
