<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Nip\Records\Record;

/**
 * @method CartPromotion getModelFromRequest()
 */
trait MktPromotionActionsControllerTrait
{
    use AbstractControllerTrait;

    public function view()
    {
        parent::view();

        $promotion = $this->getModelFromRequest();

        $promotionActions = $promotion->getPromotionActions();
        $promotionCodes = $promotion->getPromotionCodes();
        $promotionRules = $promotion->getPromotionRules();

        $this->payload()->with([
            'promotion_actions' => $promotionActions,
            'promotion_rules' => $promotionRules,
            'promotion_codes' => $promotionCodes
        ]);
    }


    /**
     * @param PromotionAction $item
     */
    protected function checkItemAccess($item)
    {
        $promotion = $item->getPromotion();
        $pool = $item->getPromotionPool();

        $this->checkPoolAccess($pool);
    }

    /**
     * @param Record $pool
     * @return void
     */
    protected function checkPoolAccess($pool)
    {
        $this->checkAndSetForeignModelInRequest($pool);
    }
}