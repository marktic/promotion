<?php

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionSessions
 * @package Marktic\Promotion\Models\PromotionSessions
 */
class PromotionSessions extends RecordManager
{
    use PromotionSessionsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_promotions_sessions';
    public const CONTROLLER = 'mkt_promotion_sessions';

    public const RELATION_SUBJECT = 'PromotionSubject';

}
