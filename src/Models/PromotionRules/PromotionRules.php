<?php

namespace Marktic\Promotion\Models\PromotionRules;

use Marktic\Promotion\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionRules
 * @package Marktic\Promotion\Models\PromotionRules
 */
class PromotionRules extends RecordManager
{
    use PromotionRulesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions';

}
