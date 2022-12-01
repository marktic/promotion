<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\PromotionSessions\Actions\CreateSessionForPromotionApplication;
use Marktic\Promotion\Utility\PromotionServices;

abstract class AbstractPromotionApplicator
{
    protected ?ActionCommandsService $actionService;
    protected ?CreateSessionForPromotionApplication $actionSessions;

    public function __construct(
        ?ActionCommandsService $actionsService = null,
        ?CreateSessionForPromotionApplication $actionSessions = null
    ) {
        $this->actionService = $actionsService ?? PromotionServices::actionCommands();
        $this->actionSessions = $actionSessions ?? new CreateSessionForPromotionApplication();
    }

    protected function getActionCommandFor(PromotionActionInterface $promotionAction
    ): PromotionActionCommandInterface|null {
        return $this->actionService->forAction($promotionAction);
    }
}
