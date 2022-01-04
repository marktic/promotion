<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasPromotion;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;

/**
 * @method CartPromotion|null getPromotion()
 */
trait RecordHasPromotion
{
    protected ?int $promotion_id = null;

    /**
     * @return int|null
     */
    public function getPromotionId(): ?int
    {
        return $this->promotion_id;
    }

    /**
     * @param int|null $promotion_id
     */
    public function setPromotionId(?int $promotion_id): void
    {
        $this->promotion_id = $promotion_id;
    }


}
