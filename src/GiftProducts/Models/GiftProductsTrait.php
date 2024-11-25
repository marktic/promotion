<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPool\RepositoryHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

trait GiftProductsTrait
{
    use RepositoryHasPool;
    use TimestampableManagerTrait;

    /**
     * @return void
     */
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsPromotions();
    }

    protected function initRelationsPromotions(): void
    {
        $this->initRelationsPromotionPool();
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::GIFT_PRODUCTS, GiftProducts::TABLE);
    }
}
