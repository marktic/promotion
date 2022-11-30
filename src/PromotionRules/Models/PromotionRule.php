<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionRule.
 */
class PromotionRule extends Record implements PromotionRuleInterface
{
    use CommonRecordTrait;
    use PromotionRuleTrait;

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
