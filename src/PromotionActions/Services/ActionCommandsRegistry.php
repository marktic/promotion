<?php

namespace Marktic\Promotion\PromotionActions\Services;

use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactory;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactoryInterface;
use Marktic\Promotion\PromotionActions\Utils\ActionCommands;

class ActionCommandsRegistry
{
    protected PromotionActionCommandFactoryInterface $factory;

    protected ?array $commands = null;

    /**
     * @param PromotionActionCommandFactoryInterface $factory
     */
    public function __construct(PromotionActionCommandFactoryInterface $factory = null)
    {
        $this->factory = $factory ?? new PromotionActionCommandFactory();
    }

    public function all(): array
    {
        $this->bootCommands();
        return $this->commands;
    }

    protected function bootCommands()
    {
        if ($this->commands !== null) {
            return;
        }
        $this->commands = [];
        $baseCommands = $this->baseCommandsArray();
        foreach ($baseCommands as $type => $class) {
            $this->commands[$type] = $this->factory->create($type);
        }
    }

    protected function baseCommandsArray(): array
    {
        return ActionCommands::classes();
    }
}