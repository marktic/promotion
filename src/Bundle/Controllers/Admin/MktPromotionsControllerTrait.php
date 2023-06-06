<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Admin\Promotions\AutomaticForm;
use Marktic\Promotion\Bundle\Forms\Admin\Promotions\CouponCodeForm;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\CartPromotions\Models\Types\CouponCode;
use Marktic\Promotion\Promotions\Actions\Usage\RecalculatePromotionUsage;
use Marktic\Promotion\Utility\PromotionFactories;
use Marktic\Promotion\Utility\PromotionModels;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\Records\Record;

/**
 * @method CartPromotion getModelFromRequest()
 */
trait MktPromotionsControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    public function poolIndex(): void
    {
        $this->doModelsListing();

        $this->payload()->with([
            'pool' => $this->getRequest()->get('pool'),
            'pool_id' => $this->getRequest()->get('pool_id'),
            'actionCommands' => PromotionServices::actionCommands()->all(),
            'promotionTypes' => PromotionModels::promotions()->getTypes(),
        ]);
    }

    public function view()
    {
        parent::view();

        $promotion = $this->getModelFromRequest();

        $promotionActions = $promotion->getPromotionActions();
        $promotionCodes = $promotion->getPromotionCodes();
        $promotionRules = $promotion->getPromotionRules();
        $promotionSessions = $promotion->getPromotionSessions();

        $this->payload()->with([
            'promotion_actions' => $promotionActions,
            'promotion_rules' => $promotionRules,
            'promotion_codes' => $promotionCodes,
            'promotion_sessions' => $promotionSessions,
        ]);
    }

    public function recalculateUses()
    {
        $promotion = $this->getModelFromRequest();
        RecalculatePromotionUsage::for($promotion)->handle();
        $this->flashRedirect(
            $this->getModelManager()->getMessage('recalculate'),
            $promotion->compileURL('view'),
        );
    }

    public function addNewModel(): \Nip\Records\AbstractModels\Record
    {
        /** @var CartPromotion $item */
        $item = parent::addNewModel();

        $item->setPool($this->getRequest()->get('pool'));
        $item->setPoolId((int) $this->getRequest()->get('pool_id'));
        $item->setTypeObject($this->getRequest()->get('type'));

        $actionType = $this->getRequest()->get('action_type');
        $promotionAction = PromotionFactories::actions()->create($actionType, []);

        $item->getRelation(CartPromotions::RELATION_ACTIONS)->getResults()->add($promotionAction);

        return $item;
    }

    protected function forwardToPoolIndex()
    {
        $this->forward('poolIndex');
    }

    /**
     * {@inheritDoc}
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

        if (CouponCode::NAME == $type) {
            return CouponCodeForm::class;
        }

        return AutomaticForm::class;
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
     *
     * @return void
     */
    protected function checkPoolAccess($pool)
    {
        $this->checkAndSetForeignModelInRequest($pool);
    }
}
