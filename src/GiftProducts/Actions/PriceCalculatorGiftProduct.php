<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Actions;

use Bytic\Actions\Action;

class PriceCalculatorGiftProduct extends Action
{
    public function for($giftProduct)
    {
        return \ByTIC\Money\Utility\Money::fromCents(0);
    }
}