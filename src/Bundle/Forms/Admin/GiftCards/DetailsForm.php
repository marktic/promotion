<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\GiftCards;


use Marktic\Promotion\Bundle\Forms\AbstractBase\GiftCards\BuyFormTrait;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\Utility\PromotionModels;

/**
 * @method GiftCard getModel()
 */
class DetailsForm extends AbstractForm
{
    use BuyFormTrait {
        getDataFromModel as protected getDataFromModelTrait;
    }

    public function getDataFromModel()
    {
        $this->getDataFromModelTrait();

        $this->addSelect('status_new', translator()->trans('status'), true);
        $statusElement = $this->getElement('status_new');
        $statuses = PromotionModels::giftCards()->getStatuses();
        foreach ($statuses as $status) {
            $statusElement->addOption($status->getName(), $status->getLabel());
        }

        $statusElement->setValue($this->getModel()->status);
    }
    public function saveModel(): void
    {
        $status_new = $this->getModel()->status_new;
        $status_db = $this->getModel()->getRawOriginal('status');
        if (!empty($status_new) && $status_new != $status_db) {
            $this->getModel()->updateStatus($status_new);
            return;
        }
        parent::saveModel();
    }
}
