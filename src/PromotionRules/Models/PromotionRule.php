<?php

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionRule
 * @package Marktic\Promotion\Models\PromotionRules
 */
class PromotionRule extends Record implements PromotionRuleInterface
{
    use PromotionRuleTrait;
    use CommonRecordTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
        $this->registerCastConfiguration();
    }

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
