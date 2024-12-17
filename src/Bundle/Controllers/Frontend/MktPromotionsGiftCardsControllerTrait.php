<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Frontend;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Frontend\GiftCards\BuyForm;
use Marktic\Promotion\GiftCards\Actions\GenerateForProduct;
use Marktic\Promotion\GiftProducts\Actions\PriceCalculatorGiftProduct;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Nip\Container\Utility\Container;
use Nip\Records\Record;

/**
 * @method GiftProduct getModelFromRequest()
 */
trait MktPromotionsGiftCardsControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    public function paymentRedirect()
    {
                
    }

    public function thankYou()
    {
        $giftCard = $this->getModelFromRequest();

        $this->payload()->with([
            'giftCard' => $giftCard,
        ]);
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
