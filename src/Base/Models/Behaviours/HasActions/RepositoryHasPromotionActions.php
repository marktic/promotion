<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasActions;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\Utility\PromotionModels;

trait RepositoryHasPromotionActions
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

    protected function initRelationsPromotionActions(): void
    {
        $this->hasMany(CartPromotions::RELATION_ACTIONS, ['class' => \get_class(PromotionModels::promotionActions())]);
    }
}
