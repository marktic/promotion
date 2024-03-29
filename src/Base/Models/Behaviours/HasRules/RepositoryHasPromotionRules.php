<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasRules;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\Utility\PromotionModels;

trait RepositoryHasPromotionRules
{
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsPromotions();
    }

    protected function initRelationsPromotions()
    {
        $this->initRelationsPromotionRules();
    }

    protected function initRelationsPromotionRules(): void
    {
        $this->hasMany(CartPromotions::RELATION_RULES, ['class' => \get_class(PromotionModels::promotionRules())]);
    }
}
