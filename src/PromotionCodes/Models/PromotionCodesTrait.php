<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RepositoryHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\Record;

trait PromotionCodesTrait
{
    use RepositoryHasPromotion;
    use TimestampableManagerTrait;

    public function findOneByCode(string $code): PromotionCodeInterface|Record|null
    {
        return $this->findOneByField('code', $code) ?? null;
    }

    protected function initRelations(): void
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
        return PackageConfig::tableName(PromotionModels::PROMOTION_CODES, PromotionCodes::TABLE);
    }
}
