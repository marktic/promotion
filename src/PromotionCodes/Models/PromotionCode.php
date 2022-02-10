<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionCode
 * @package Marktic\Promotion\Models\PromotionCodes
 */
class PromotionCode extends Record implements PromotionCodeInterface
{
    use PromotionCodeTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
