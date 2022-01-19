<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface RuleConditionInterface
{
    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool;

    public function describeConfiguration(ModelConfiguration $configuration): string;
}
