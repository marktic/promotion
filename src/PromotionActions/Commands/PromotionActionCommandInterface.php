<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Base\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface PromotionActionCommandInterface
{
    public function execute(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): bool;

    public function revert(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): void;
}