<?php

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

trait PromotionActionsTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTION_ACTIONS, PromotionActions::TABLE);
    }
}