<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Services;

use Marktic\Promotion\PromotionRules\Conditions\RuleConditionInterface;

interface RuleConditionsServiceInterface
{
    public function all(): array;

    public function add(RuleConditionInterface $condition);

    public function get(string $name): RuleConditionInterface;
}
