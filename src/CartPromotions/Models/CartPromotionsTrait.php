<?php

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;

trait CartPromotionsTrait
{
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsTrait();
    }

    protected function initRelationsTrait()
    {
        $this->initRelationsPromotionPool();
        $this->initRelationsPromotionCodes();
        $this->initRelationsPromotionActions();
        $this->initRelationsPromotionRules();
    }

    protected function initRelationsPromotionPool()
    {
        $this->morphTo(CartPromotions::RELATION_POOL, ['morphPrefix' => 'pool', 'morphTypeField' => 'pool']);
    }

    protected function initRelationsPromotionCodes()
    {
        $this->hasMany(CartPromotions::RELATION_CODES, ['class' => get_class(PromotionModels::promotionCodes())]);
    }

    protected function initRelationsPromotionActions()
    {
        $this->hasMany(CartPromotions::RELATION_ACTIONS, ['class' => get_class(PromotionModels::promotionActions())]);
    }

    protected function initRelationsPromotionRules()
    {
        $this->hasMany(CartPromotions::RELATION_RULES, ['class' => get_class(PromotionModels::promotionRules())]);
    }

    public function generatePrimaryFK()
    {
        return 'promotion_id';
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTIONS, CartPromotions::TABLE);
    }
}