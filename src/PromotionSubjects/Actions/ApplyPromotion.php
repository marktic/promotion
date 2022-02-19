<?php

namespace Marktic\Promotion\PromotionSubjects\Actions;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSessions\Actions\CreateSessionForPromotionApplication;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PromotionServices;

class ApplyPromotion
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

    public function apply(PromotionSubjectInterface $subject, PromotionInterface $promotion)
    {
        $appliedPromotions = [];

        foreach ($promotion->getPromotionActions() as $action) {
            $result = $this
                ->getActionCommandfor($action)
                ->execute($subject, (array)$action->getConfiguration(), $promotion);
            if ($result) {
                $appliedPromotions[] = $action;
            }
        }

        if (count($appliedPromotions)) {
            $this->actionSessions->create($subject, $promotion, $appliedPromotions);
        }
    }

    protected function getActionCommandFor(PromotionActionInterface $promotionAction): PromotionActionCommandInterface
    {
        return $this->actionService->forAction($promotionAction);
    }
}
