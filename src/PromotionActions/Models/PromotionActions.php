<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionActions.
 */
class PromotionActions extends RecordManager
{
    use CommonRecordsTrait;
    use PromotionActionsTrait;

    public const TABLE = 'mkt_promotions_actions';
    public const CONTROLLER = 'mkt_promotion_actions';

    public const RELATION_POOL = 'Promotion';
}
