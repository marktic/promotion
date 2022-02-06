<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ItemTotalRuleCondition implements RuleConditionInterface
{
    public const NAME = 'item_total';

    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool
    {
        return $subject->getPromotionSubjectTotal() >= $configuration['amount'];
    }

    public function describeConfiguration(ModelConfiguration $configuration): string
    {
        // TODO: Implement describeConfiguration() method.
        return '';
    }
}