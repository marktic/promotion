<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Services;

use InvalidArgumentException;
use Marktic\Promotion\PromotionRules\Conditions\RuleConditionInterface;
use Marktic\Promotion\PromotionRules\Models\PromotionRule;

class RuleConditionsService
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
     * @return RuleConditionInterface|null
     */
    public function forRule($rule): ?RuleConditionInterface
    {
        return $this->get($rule->getType());
    }

    /**
     * @param string $name
     * @return RuleConditionInterface
     */
    public function get(string $name): RuleConditionInterface
    {
        if (!isset($this->items[$name])) {
            throw new InvalidArgumentException(sprintf('Condition with name "%s" does not exist', $name));
        }

        return $this->items[$name];
    }

    public function addFromConfig($classes)
    {
        foreach ($classes as $class) {
            $this->add(new $class());
        }
    }

    /**
     * @param RuleConditionInterface $condition
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
        $class = get_class($condition);
        if (defined($class . '::NAME')) {
            return $class::NAME;
        }
        throw new InvalidArgumentException(sprintf('Condition "%s" does not have a name', $class));
    }
}