<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionCodes
 * @package Marktic\Promotion\Models\PromotionCodes
 */
class PromotionCodes extends RecordManager
{
    use PromotionCodesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions_codes';
    public const CONTROLLER = 'mkt_promotion_codes';

}
