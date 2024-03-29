<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RepositoryHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

/**
 * @method PromotionActionInterface getNewRecord
 */
trait PromotionActionsTrait
{
    use RepositoryHasPromotion;
    use TimestampableManagerTrait;

    /**
     * @return void
     */
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsTrait();
    }

    protected function initRelationsTrait(): void
    {
        $this->initRelationsPromotion();
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTION_ACTIONS, PromotionActions::TABLE);
    }
}
