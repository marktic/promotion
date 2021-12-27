<?php

namespace Marktic\Promotion\Models\PromotionRules;

use Marktic\Promotion\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionRule
 * @package Marktic\Promotion\Models\PromotionRules
 */
class PromotionRule extends Record
{
    use PromotionRuleTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
