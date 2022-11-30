<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionRules.
 */
class PromotionRules extends RecordManager
{
    use CommonRecordsTrait;
    use PromotionRulesTrait;

    public const TABLE = 'mkt_promotions_rules';
    public const CONTROLLER = 'mkt_promotion_rules';
}
