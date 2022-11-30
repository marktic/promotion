<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasPromotion;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\Promotions\Models\PromotionInterface;

trait RecordHasPromotion
{
    protected ?int $promotion_id = null;

    public function getPromotionId(): ?int
    {
        return $this->promotion_id;
    }

    public function setPromotionId(?int $promotion_id): void
    {
        $this->promotion_id = $promotion_id;
    }

    public function getPromotionPool()
    {
        return $this->getPromotion()->getPromotionPool();
    }

    public function populateFromPromotion(PromotionInterface $promotion)
    {
        $this->setPromotionId($promotion->id);
        $this->getRelation('Promotion')->setResults($promotion);
    }

    /**
     * @return CartPromotion|null
     */
    public function getPromotion(): ?PromotionInterface
    {
        return $this->getRelation('Promotion')->getResults();
    }
}
