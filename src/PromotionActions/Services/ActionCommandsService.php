<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Services;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionActions\DataObjects\PromotionActionType;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactory;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactoryInterface;

class ActionCommandsService
{
    protected PromotionActionCommandFactoryInterface $factory;

    /**
     * @var PromotionActionCommandInterface[]|null
     */
    protected ?array $commands = null;

    /**
     * @param PromotionActionCommandFactoryInterface $factory
     */
    public function __construct(PromotionActionCommandFactoryInterface $factory = null)
    {
        $this->factory = $factory ?? new PromotionActionCommandFactory();
    }

    public function forAction($action): ?PromotionActionCommandInterface
    {
        $this->bootCommands();

        return $this->commands[$action->getType()] ?? null;
    }

    public function all(): array
    {
        $this->bootCommands();

        return $this->commands;
    }

    protected function bootCommands()
    {
        if (null !== $this->commands) {
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
        return PromotionActionType::classes();
    }
}
