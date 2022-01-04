<?php

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionRules
 * @package Marktic\Promotion\Models\PromotionRules
 */
class PromotionRules extends RecordManager
{
    use PromotionRulesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions_rules';
    public const CONTROLLER = 'mkt_promotion_rules';

}
