<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasRules;


use Marktic\Promotion\Bundle\Models\PromotionRules\PromotionRule;
use Nip\Records\Collections\Collection;

/**
 */
trait RecordHasPromotionRules
{
    public function hasPromotionRules(): bool
    {
        return $this->getPromotionRules()->count() > 0;
    }

    /**
     * @return Collection|PromotionRule[]
     */
    public function getPromotionRules()
    {
        return $this->getRelation('PromotionRules')->getResults();
    }

    public function setPromotionRules($promotionRules)
    {
        $this->getRelation('PromotionRules')->setResults($promotionRules);
    }
}
