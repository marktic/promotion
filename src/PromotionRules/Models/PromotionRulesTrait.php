<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RepositoryHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

/**
 * @method PromotionRule getNew()
 */
trait PromotionRulesTrait
{
    use RepositoryHasPromotion;
    use TimestampableManagerTrait;

    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsTrait();
    }

    protected function initRelationsTrait()
    {
        $this->initRelationsPromotion();
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTION_RULES, PromotionRules::TABLE);
    }
}
