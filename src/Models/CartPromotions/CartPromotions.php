<?php

namespace Marktic\Promotion\Models\CartPromotions;

use Marktic\Promotion\Models\AbstractModels\CommonRecordsTrait;
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

}
