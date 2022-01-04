<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use Marktic\Promotion\Bundle\Forms\Admin\PromotionActions\BaseForm;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionActions\FixedDiscountForm;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionActions\FixedPriceForm;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionActions\PercentageDiscountForm;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Commands\FixedPriceActionCommand;
use Marktic\Promotion\PromotionActions\Commands\PercentageDiscountActionCommand;
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
        $this->checkAndSetForeignModelInRequest($promotion);

        $pool = $promotion->getPromotionPool();

        $this->checkPoolAccess($pool);
    }

    protected function getModelFormClass($model, $action = null): string
    {
        $type = $this->getModelFromRequest()->getType();

        switch ($type) {
            case PercentageDiscountActionCommand::NAME:
                return PercentageDiscountForm::class;

            case FixedDiscountActionCommand::NAME:
                return FixedDiscountForm::class;

            case FixedPriceActionCommand::NAME:
                return FixedPriceForm::class;
        }

        return BaseForm::class;
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