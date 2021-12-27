<?php

namespace Marktic\Promotion\Tests\Models\CartPromotions;

use Marktic\Promotion\Models\PromotionRules\PromotionRules;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class PromotionRulesTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionRules::class;
    }
}
