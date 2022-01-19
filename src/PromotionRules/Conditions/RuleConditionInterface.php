<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface RuleConditionInterface
{
    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool;
}
