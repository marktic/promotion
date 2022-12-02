<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionSubjects\Models\CountablePromotionSubjectInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ItemQuantityRuleCondition implements RuleConditionInterface
{
    public const NAME = 'item_quantity';

    public const CONF_MIN_ITEMS = 'min_items';
    public const CONF_MAX_ITEMS = 'max_items';

    public function validate(PromotionSubjectInterface $subject, $configuration): ValidationResult
    {
        if (false === ($subject instanceof CountablePromotionSubjectInterface)) {
            return ValidationResult::invalid('The subject is not an instance of CountablePromotionSubjectInterface');
        }

        $totalItems = $subject->getPromotionSubjectCount();

        $minItems = $configuration[self::CONF_MIN_ITEMS] ?? null;
        if ($minItems && $totalItems < $minItems) {
            return ValidationResult::invalid('The total of the items is not enough');
        }

        $maxItems = $configuration[self::CONF_MAX_ITEMS] ?? null;
        if ($maxItems && $totalItems > $maxItems) {
            return ValidationResult::invalid('The total of the items is too much');
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
            static::CONF_MIN_ITEMS => 0,
            static::CONF_MAX_ITEMS => 0,
        ];
    }
}
