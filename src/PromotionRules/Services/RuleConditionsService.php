<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Services;

use Marktic\Promotion\PromotionRules\Conditions\RuleConditionInterface;
use Marktic\Promotion\PromotionRules\Models\PromotionRule;

class RuleConditionsService implements RuleConditionsServiceInterface
{
    /**
     * @var RuleConditionInterface[]
     */
    private array $items = [];

    public function all(): array
    {
        return $this->items;
    }

    /**
     * @param PromotionRule $rule
     */
    public function forRule($rule): ?RuleConditionInterface
    {
        return $this->get($rule->getType());
    }

    public function get(string $name): RuleConditionInterface
    {
        if (!isset($this->items[$name])) {
            throw new \InvalidArgumentException(sprintf('Condition with name "%s" does not exist', $name));
        }

        return $this->items[$name];
    }

    public function addFromConfig($classes): void
    {
        foreach ($classes as $class) {
            $this->add(new $class());
        }
    }

    /**
     * @return void
     */
    public function add(RuleConditionInterface $condition)
    {
        $this->items[$this->keyFor($condition)] = $condition;
    }

    protected function keyFor(RuleConditionInterface $condition): string
    {
        if (method_exists($condition, 'getName')) {
            return $condition->getName();
        }
        $class = \get_class($condition);
        if (\defined($class . '::NAME')) {
            return $class::NAME;
        }
        throw new \InvalidArgumentException(sprintf('Condition "%s" does not have a name', $class));
    }
}
