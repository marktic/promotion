<?php

namespace Marktic\Promotion\Tests\PromotionRules\Models;

use Marktic\Promotion\Bundle\Models\PromotionRules\PromotionRule;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasConfiguration\RecordHasConfigurationTestTrait;

class PromotionRuleTest extends AbstractRecordTest
{
    use RecordHasConfigurationTestTrait;

    protected function getRecordClass(): string
    {
        return PromotionRule::class;
    }
}
