<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class PromotionCodes.
 *
 * @method PromotionCode getNew($data = [])
 */
class PromotionCodes extends RecordManager implements PromotionCodesRepositoryInterface
{
    use CommonRecordsTrait;
    use PromotionCodesTrait;

    public const TABLE = 'mkt_promotions_codes';
    public const CONTROLLER = 'mkt_promotion_codes';
}
