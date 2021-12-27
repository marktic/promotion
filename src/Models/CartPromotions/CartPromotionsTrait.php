<?php

namespace Marktic\Promotion\Models\CartPromotions;

use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

trait CartPromotionsTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTIONS, CartPromotions::TABLE);
    }
}