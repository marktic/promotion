<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Frontend;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Controllers\Admin\AbstractControllerTrait;
use Marktic\Promotion\Bundle\Forms\Admin\GiftProducts\ValueCardForm;
use Marktic\Promotion\Bundle\Forms\Admin\GiftProducts\CouponCardForm;
use Marktic\Promotion\GiftProducts\Actions\PriceCalculatorGiftProduct;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\GiftProducts\Models\Types\CouponCard;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\Container\Utility\Container;
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
            'priceCalculator' => $this->getPriceCalculator(),
        ]);
    }

    public function view()
    {
        parent::view();

        $promotion = $this->getModelFromRequest();

        $this->payload()->with([
        ]);
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

    protected function getPriceCalculator()
    {
        $container = Container::container();
        return $container->get(PriceCalculatorGiftProduct::class);
    }
}
