<?php

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

    /**
     * @param string $code
     * @return PromotionCode|Record
     */
    public function findOneByCode(string $code): ?PromotionCodeInterface
    {
        return $this->findOneByField('code', $code) ?? null;
    }

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
        return PackageConfig::tableName(PromotionModels::PROMOTION_CODES, PromotionCodes::TABLE);
    }
}