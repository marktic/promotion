<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionSessions.
 */
class PromotionSessions extends RecordManager
{
    use CommonRecordsTrait;
    use PromotionSessionsTrait;

    public const TABLE = 'mkt_promotions_sessions';
    public const CONTROLLER = 'mkt_promotion_sessions';

    public const RELATION_SUBJECT = 'PromotionSubject';
}
