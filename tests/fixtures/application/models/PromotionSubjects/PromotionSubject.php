<?php

namespace Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects;

use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectRecordTrait;

class PromotionSubject implements PromotionSubjectInterface
{
    use PromotionSubjectRecordTrait;

    public function getPromotionSubjectTotal(): float
    {
        return 100;
    }
}
