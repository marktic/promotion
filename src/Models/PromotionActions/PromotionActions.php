<?php

namespace Marktic\Promotion\Models\PromotionActions;

use Marktic\Promotion\Models\AbstractModels\CommonRecordsTrait;
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

}
