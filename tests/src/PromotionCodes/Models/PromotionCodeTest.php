<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionCodes\Models;

use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasValidity\RecordHasValidityTestTrait;

class PromotionCodeTest extends AbstractRecordTest
{
    use RecordHasValidityTestTrait;

    protected function getRecordClass(): string
    {
        return PromotionCode::class;
    }
}
