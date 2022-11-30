<?php

declare(strict_types=1);

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
use Nip\Controllers\Response\ResponsePayload;
use Nip\Records\AbstractModels\Record;
use Nip\Utility\Url;

/**
 * @method CartPromotion getModelFromRequest()
 */
trait MktPromotionActionsControllerTrait
{
    use AbstractControllerTrait;

    public function edit()
    {
        $item = $this->getModelFromRequest();
        $this->setAfterUrl(
            'after-edit',
            Url::copyQuery($item->compileURL('edit'), [ResponsePayload::REQUEST_PARAM_FORMAT], $this->getRequest())
        );
        parent::edit();
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
     *
     * @return void
     */
    protected function checkPoolAccess($pool)
    {
        $this->checkAndSetForeignModelInRequest($pool);
    }
}
