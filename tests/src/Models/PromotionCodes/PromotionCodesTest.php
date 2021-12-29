<?php

namespace Marktic\Promotion\Tests\Models\PromotionCodes;

use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class PromotionCodesTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionCodes::class;
    }
}
