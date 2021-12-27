<?php

namespace Marktic\Promotion\Models\CartPromotions;

use Marktic\Promotion\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class CartPromotion
 * @package Marktic\Promotion\Models\Events
 */
class CartPromotion extends Record
{
    use CartPromotionTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
