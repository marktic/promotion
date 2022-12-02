<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Models;

interface CountablePromotionSubjectInterface extends PromotionSubjectInterface
{
    public function getPromotionSubjectCount(): int;
}