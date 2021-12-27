<?php

namespace Marktic\Promotion\Models\PromotionCodes;

use Marktic\Promotion\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionCode
 * @package Marktic\Promotion\Models\PromotionCodes
 */
class PromotionCode extends Record
{
    use PromotionCodeTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
