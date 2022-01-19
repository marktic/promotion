<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Services;

use Marktic\Promotion\PromotionRules\Conditions\RuleConditionInterface;

interface RuleConditionsServiceInterface
{
    public function all(): array;

    /**
     * @param RuleConditionInterface $condition
     */
    public function add(RuleConditionInterface $condition);

    /**
     * @param string $name
     * @return RuleConditionInterface
     */
    public function get(string $name): RuleConditionInterface;
}