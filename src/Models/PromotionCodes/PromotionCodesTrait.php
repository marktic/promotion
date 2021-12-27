<?php

namespace Marktic\Promotion\Models\PromotionCodes;

use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

trait PromotionCodesTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTION_CODES, PromotionCodes::TABLE);
    }
}