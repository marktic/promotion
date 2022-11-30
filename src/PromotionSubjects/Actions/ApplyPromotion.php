<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Actions;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\PromotionSessions\Actions\CreateSessionForPromotionApplication;
use Marktic\Promotion\PromotionSubjects\DataObjects\ApplyPromotionRequest;
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

    public function apply(ApplyPromotionRequest $applyPromotionRequest): void
    {
        $appliedPromotions = $this->applyActions($applyPromotionRequest);

        if (\count($appliedPromotions)) {
            $applyPromotionRequest->setAppliedActions($appliedPromotions);
            $this->applyPromotion($applyPromotionRequest);
        }
    }

    protected function applyActions(ApplyPromotionRequest $applyPromotionRequest): array
    {
        $appliedPromotions = [];
        $promotion = $applyPromotionRequest->getPromotion();

        foreach ($promotion->getPromotionActions() as $action) {
            $result = $this
                ->getActionCommandfor($action)
                ->execute($applyPromotionRequest->getSubject(), (array) $action->getConfiguration(), $promotion);
            if ($result) {
                $appliedPromotions[] = $action;
            }
        }

        return $appliedPromotions;
    }

    protected function applyPromotion(ApplyPromotionRequest $applyPromotionRequest): void
    {
        $this->actionSessions->createForRequest($applyPromotionRequest);

        $promotion = $applyPromotionRequest->getPromotion();
        $promotion->incrementUsed();
        $promotion->save();

        if ($applyPromotionRequest->hasPromotionCode()) {
            $promotionCode = $applyPromotionRequest->getPromotionCode();
            $promotionCode->incrementUsed();
            $promotionCode->save();
        }
    }

    protected function getActionCommandFor(PromotionActionInterface $promotionAction): PromotionActionCommandInterface|null
    {
        return $this->actionService->forAction($promotionAction);
    }
}
