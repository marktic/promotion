<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionCode.
 */
class PromotionCode extends Record implements PromotionCodeInterface
{
    use CommonRecordTrait;
    use PromotionCodeTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
