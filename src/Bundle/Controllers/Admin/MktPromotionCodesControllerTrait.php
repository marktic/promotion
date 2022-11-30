<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use Marktic\Promotion\Bundle\Forms\Admin\PromotionCodes\BaseForm;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Nip\Controllers\Response\ResponsePayload;
use Nip\Records\Record;
use Nip\Utility\Url;

/**
 * @method CartPromotion getModelFromRequest()
 */
trait MktPromotionCodesControllerTrait
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
     * @param PromotionCode $item
     */
    protected function checkItemAccess($item)
    {
        $promotion = $item->getPromotion();
        $this->checkAndSetForeignModelInRequest($promotion);

        $pool = $promotion->getPromotionPool();

        $this->checkPoolAccess($pool);
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

    protected function getModelFormClass($model, $action = null): string
    {
        return BaseForm::class;
    }
}
