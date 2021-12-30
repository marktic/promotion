<?php

namespace Marktic\Promotion\Tests\PromotionRules\Models;

use Marktic\Promotion\PromotionRules\Models\PromotionRules;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionRulesTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionRules::class;
    }
}
