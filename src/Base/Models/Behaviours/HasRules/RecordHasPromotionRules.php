<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasRules;

use Nip\Records\Collections\Collection;

trait RecordHasPromotionRules
{
    public function hasPromotionRules(): bool
    {
        return $this->getPromotionRules()->count() > 0;
    }

    public function getPromotionRules(): \Nip\Records\AbstractModels\Record|Collection
    {
        return $this->getRelation('PromotionRules')->getResults();
    }

    /**
     * @return void
     */
    public function setPromotionRules($promotionRules)
    {
        $this->getRelation('PromotionRules')->setResults($promotionRules);
    }
}
