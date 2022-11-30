<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Nip\Records\Record;

/**
 * Class CartPromotion.
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
