<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Admin\Promotions\BaseForm;
use Marktic\Promotion\Bundle\Forms\Admin\Promotions\FixedDiscountForm;
use Marktic\Promotion\Bundle\Forms\Admin\Promotions\FixedPriceForm;
use Marktic\Promotion\Bundle\Forms\Admin\Promotions\PercentageDiscountForm;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Commands\FixedPriceActionCommand;
use Marktic\Promotion\PromotionActions\Commands\PercentageDiscountActionCommand;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\Records\Record;

/**
 * @method CartPromotion getModelFromRequest()
 */
trait MktPromotionsControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    public function poolIndex()
    {
        $this->doModelsListing();

        $this->payload()->with([
            'pool' => $this->getRequest()->get('pool'),
            'pool_id' => $this->getRequest()->get('pool_id'),
            'actionCommands' => PromotionServices::actionCommands()->all()
        ]);
    }

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

    public function addNewModel(): \Nip\Records\AbstractModels\Record
    {
        /** @var CartPromotion $item */
        $item = parent::addNewModel();
        $item->setPool($this->getRequest()->get('pool'));
        $item->setPoolId($this->getRequest()->get('pool_id'));
        return $item;
    }


    protected function forwardToPoolIndex()
    {
        $this->forward('poolIndex');
    }


    /**
     * @inheritDoc
     */
    protected function parseRequest()
    {
        $this->parseRequestForPool();
        parent::parseRequest();
    }

    protected function parseRequestForPool()
    {
        $pool = $this->getRequest()->get('pool');
        if (!empty($pool)) {
            $this->checkForeignModelFromRequest($pool, 'pool_id');
        }

        if ($this->getRequest()->get('id')) {
            $this->getModelFromRequest();
        }
    }

    protected function getModelFormClass($model, $action = null): string
    {
        $type = $this->getRequest()->get('type');

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
     * @param CartPromotion $item
     */
    protected function checkItemAccess($item)
    {
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