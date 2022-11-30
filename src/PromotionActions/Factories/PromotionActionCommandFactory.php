<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Factories;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionActions\DataObjects\PromotionActionType;

class PromotionActionCommandFactory implements PromotionActionCommandFactoryInterface
{
    protected array $classes = [];

    public function __construct()
    {
        $this->classes = PromotionActionType::classes();
    }

    public function create(string $type): PromotionActionCommandInterface
    {
        $command = $this->tryCreateFromClasses($type);
        if ($command instanceof PromotionActionCommandInterface) {
            return $command;
        }

        throw new \InvalidArgumentException(sprintf('Invalid action type "%s"', $type));
    }

    protected function tryCreateFromClasses($type)
    {
        if (!isset($this->classes[$type])) {
            return null;
        }

        $class = $this->classes[$type];

        return new $class();
    }
}
