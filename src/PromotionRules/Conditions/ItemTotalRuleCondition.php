<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ItemTotalRuleCondition implements RuleConditionInterface
{
    public const NAME = 'item_total';

    public function validate(PromotionSubjectInterface $subject, $configuration): ValidationResult
    {
        if ($subject->getPromotionSubjectTotal() >= $configuration['amount']) {
            return ValidationResult::valid();
        }

        return ValidationResult::invalid('The total of the items is not enough');
    }

    public function describeConfiguration(ModelConfiguration $configuration): string
    {
        // TODO: Implement describeConfiguration() method.
        return '';
    }
}
