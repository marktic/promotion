<?php

namespace Marktic\Promotion\Tests\Models\CartPromotions;

use Marktic\Promotion\Models\PromotionCodes\PromotionCodes;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class PromotionCodesTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionCodes::class;
    }
}
