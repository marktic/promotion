<?php

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

trait PromotionRulesTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTION_RULES, PromotionRules::TABLE);
    }
}