<?php

namespace Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects;

use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectRecordTrait;

class PromotionSubject implements PromotionSubjectInterface
{
    use PromotionSubjectRecordTrait;

    public function priceBeforeAdjustments($currency = null): float
    {
        return 100;
    }

    public function getPromotionSubjectTotal(): float
    {
        return 100;
    }
}
