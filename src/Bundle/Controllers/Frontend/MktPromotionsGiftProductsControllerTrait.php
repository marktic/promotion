<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Frontend;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Frontend\GiftCards\BuyForm;
use Marktic\Promotion\GiftCards\Actions\GenerateForProduct;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\GiftProducts\Actions\PriceCalculatorGiftProduct;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
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

    public function buy()
    {
        $giftProduct = $this->getModelFromRequest();

        $giftCard = GenerateForProduct::for($giftProduct)->handle();
        $form = $this->getModelForm($giftCard);
        if ($form->execute()) {
            $this->buyRedirect($giftCard);
        }

        $this->payload()->with([
            'giftProduct' => $giftProduct,
            'form' => $form,
            'priceCalculator' => $this->getPriceCalculator(),
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

    protected function getModelFormClass($model, $action = null): string
    {
        if ($action == 'buy') {
            return BuyForm::class;
        }

        return parent::getModelFormClass($model, $action);
    }

    protected function buyRedirect(GiftCard $giftProduct)
    {
        $this->redirect(
            $giftProduct->compileURL('thankYou'),
        );
    }

}
