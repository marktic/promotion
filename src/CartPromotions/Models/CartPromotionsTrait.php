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
        $this->initRelationsPromotionCodes();
        $this->initRelationsPromotionActions();
    }

    protected function initRelationsPromotionCodes()
    {
        $this->hasMany(CartPromotions::RELATION_CODES, ['class' => get_class(PromotionModels::promotionCodes())]);
    }

    protected function initRelationsPromotionActions()
    {
        $this->hasMany(CartPromotions::RELATION_ACTIONS, ['class' => get_class(PromotionModels::promotionActions())]);
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTIONS, CartPromotions::TABLE);
    }
}