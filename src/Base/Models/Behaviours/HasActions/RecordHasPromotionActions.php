<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasActions;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Nip\Records\Collections\Collection;

trait RecordHasPromotionActions
{
    public function hasPromotionActions(): bool
    {
        return $this->getPromotionActions()->count() > 0;
    }

    public function getPromotionActions(): \Nip\Records\AbstractModels\Record|Collection
    {
        return $this->getRelation(CartPromotions::RELATION_ACTIONS)->getResults();
    }

    /**
     * @return void
     */
    public function setPromotionActions($promotionRules)
    {
        $this->getRelation(CartPromotions::RELATION_ACTIONS)->setResults($promotionRules);
    }
}
