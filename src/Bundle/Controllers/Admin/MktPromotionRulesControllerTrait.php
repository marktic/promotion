<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use Marktic\Promotion\Base\Models\PromotionPools\PromotionPoolWithCurrencies;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionRules\BaseForm;
use Marktic\Promotion\Bundle\Models\PromotionRules\PromotionRule;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Nip\Controllers\Response\ResponsePayload;
use Nip\Records\Record;
use Nip\Utility\Url;

/**
 * @method CartPromotion getModelFromRequest()
 * @method checkAndSetForeignModelInRequest()
 * @method setAfterUrl()
 */
trait MktPromotionRulesControllerTrait
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
     * @param PromotionRule $item
     */
    protected function checkItemAccess($item)
    {
        $promotion = $item->getPromotion();
        $this->checkAndSetForeignModelInRequest($promotion);

        $pool = $promotion->getPromotionPool();

        $this->checkPoolAccess($pool);
    }

    /**
     * @param PromotionPoolWithCurrencies|Record $pool
     * @return void
     */
    protected function checkPoolAccess($pool)
    {
        $this->checkAndSetForeignModelInRequest($pool);
    }

    protected function getModelFormClass($model, $action = null): string
    {
        return BaseForm::class;
    }
}