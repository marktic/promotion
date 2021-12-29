<?php

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Events
 * @package Marktic\Promotion\Models\CartPromotions
 */
class CartPromotions extends RecordManager
{
    use CartPromotionsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions';

    public const RELATION_CODES = 'PromotionCodes';

}
