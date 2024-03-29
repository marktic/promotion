<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ItemTotalRuleCondition implements RuleConditionInterface
{
    public const NAME = 'item_total';

    public const CONF_MIN_AMOUNT = 'min_amount';
    public const CONF_MAX_AMOUNT = 'max_amount';

    public function validate(PromotionSubjectInterface $subject, $configuration): ValidationResult
    {
        $subjectTotal = $subject->getPromotionSubjectTotal();
        $minAmount = $configuration[self::CONF_MIN_AMOUNT] ?? null;
        if ($minAmount && $subjectTotal < $minAmount) {
            return ValidationResult::invalid('The total amount is not enough');
        }
        $maxAmount = $configuration[self::CONF_MAX_AMOUNT] ?? null;
        if ($maxAmount && $subjectTotal > $maxAmount) {
            return ValidationResult::invalid('The total amount is too much');
        }

        return ValidationResult::valid();
    }

    public function describeConfiguration(ModelConfiguration $configuration): string
    {
        $array = $configuration->toArray();
        array_walk(
            $array,
            function (&$value, $key) {
                $value = sprintf(
                    '<span class="badge bg-secondary">
                            <strong class="text-uppercase">%s</strong>:
                            %s
                        </span>',
                    $key,
                    print_r($value, true)
                );
            }
        );

        return implode(' | ', $array);
    }

    public function basicConfiguration(): array
    {
        return [
            static::CONF_MIN_AMOUNT => 0,
            static::CONF_MAX_AMOUNT => 0,
        ];
    }
}
