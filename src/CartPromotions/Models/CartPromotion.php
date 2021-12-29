<?php

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\PromotionInterface;
use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class CartPromotion
 * @package Marktic\Promotion\Models\Events
 */
class CartPromotion extends Record implements PromotionInterface
{
    use CartPromotionTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }

}
