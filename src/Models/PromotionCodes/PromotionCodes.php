<?php

namespace Marktic\Promotion\Models\PromotionCodes;

use Marktic\Promotion\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionCodes
 * @package Marktic\Promotion\Models\PromotionCodes
 */
class PromotionCodes extends RecordManager
{
    use PromotionCodesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions';

}
