<?php

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionActions
 * @package Marktic\Promotion\Models\PromotionActions
 */
class PromotionActions extends RecordManager
{
    use PromotionActionsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions_actions';
    public const CONTROLLER = 'mkt_promotion_actions';

}
