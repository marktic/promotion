<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Events.
 */
class CartPromotions extends RecordManager
{
    use CartPromotionsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions';
    public const CONTROLLER = 'mkt_promotions';

    public const RELATION_POOL = 'PromotionPool';
    public const RELATION_CODES = 'PromotionCodes';
    public const RELATION_ACTIONS = 'PromotionActions';
    public const RELATION_RULES = 'PromotionRules';
    public const RELATION_SESSIONS = 'PromotionSessions';
}
