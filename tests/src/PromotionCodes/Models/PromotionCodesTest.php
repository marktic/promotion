<?php

namespace Marktic\Promotion\Tests\PromotionCodes\Models;

use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionCodesTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionCodes::class;
    }
}
