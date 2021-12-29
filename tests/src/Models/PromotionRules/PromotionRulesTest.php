<?php

namespace Marktic\Promotion\Tests\Models\PromotionRules;

use Marktic\Promotion\PromotionRules\Models\PromotionRules;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class PromotionRulesTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionRules::class;
    }
}
