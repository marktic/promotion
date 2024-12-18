<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\GiftCards;


use Marktic\Promotion\Bundle\Forms\AbstractBase\GiftCards\BuyFormTrait;
use Marktic\Promotion\GiftCards\Models\GiftCard;

/**
 * @method GiftCard getModel()
 */
class DetailsForm extends AbstractForm
{
    use BuyFormTrait;

}
