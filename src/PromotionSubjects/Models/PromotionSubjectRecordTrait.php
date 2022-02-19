<?php

namespace Marktic\Promotion\PromotionSubjects\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSessions\Models\PromotionSession;
use Nip\Records\Collections\Collection;
use Nip\Records\Relations\Relation;

/**
 * @method PromotionSession[] getPromotionSessions()
 * @method Relation getRelation($name)
 */
trait PromotionSubjectRecordTrait
{
    use RecordHasId;

    public function hasPromotion(PromotionInterface $promotion): bool
    {
        return $this->getPromotions()->first(function ($item) use ($promotion) {
                /** @var PromotionSession $item */
                return $item->getPromotionId() === $promotion->id;
            }) instanceof PromotionSession;
    }

    public function getPromotions(): Collection
    {
        return $this->getRelation('PromotionSessions')->getResults();
    }

    public function addPromotion(PromotionInterface $promotion): void
    {
    }

    public function removePromotion(PromotionInterface $promotion): void
    {
    }
}