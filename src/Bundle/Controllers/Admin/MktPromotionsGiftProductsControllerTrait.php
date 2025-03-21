<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Admin\GiftProducts\ValueCardForm;
use Marktic\Promotion\Bundle\Forms\Admin\GiftProducts\CouponCardForm;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\GiftProducts\Models\Types\CouponCard;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\Records\Record;

/**
 * @method GiftProduct getModelFromRequest()
 */
trait MktPromotionsGiftProductsControllerTrait
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
        ]);
    }

    public function view()
    {
        parent::view();

        $promotion = $this->getModelFromRequest();

        $this->payload()->with([
        ]);
    }

    public function addNewModel(): \Nip\Records\AbstractModels\Record
    {
        /** @var GiftProduct $item */
        $item = parent::addNewModel();

        $item->setPool($this->getRequest()->get('pool'));
        $item->setPoolId((int) $this->getRequest()->get('pool_id'));
        $item->setTypeObject($this->getRequest()->get('type', ));

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

        if (CouponCard::NAME == $type) {
            return CouponCardForm::class;
        }

        return ValueCardForm::class;
    }

    /**
     * @param GiftProduct $item
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
