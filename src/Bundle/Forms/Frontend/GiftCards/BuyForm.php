<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Frontend\GiftCards;


use Marktic\Promotion\Bundle\Forms\AbstractBase\GiftCards\BuyFormTrait;
use Marktic\Promotion\GiftCards\Models\GiftCard;

/**
 * @method GiftCard getModel()
 */
class BuyForm extends AbstractForm
{
    use BuyFormTrait;

}
