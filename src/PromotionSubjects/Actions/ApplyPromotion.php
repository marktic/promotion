<?php

namespace Marktic\Promotion\PromotionSubjects\Actions;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSessions\Actions\CreateSessionForPromotionApplication;
use Marktic\Promotion\PromotionSubjects\DataObjects\ApplyPromotionRequest;
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

    public function apply(ApplyPromotionRequest $applyPromotionRequest)
    {
        $appliedPromotions = $this->applyActions($applyPromotionRequest);

        if (count($appliedPromotions)) {
            $applyPromotionRequest->setAppliedActions($appliedPromotions);
            $this->applyPromotion($applyPromotionRequest);
        }
    }

    public function applyWithCode(
        PromotionSubjectInterface $subject,
        PromotionInterface $promotion,
        PromotionCodeInterface $promotionCode
    ) {
        $appliedPromotions = $this->applyActions($subject, $promotion);

        if (count($appliedPromotions)) {
            $this->applyPromotion($subject, $promotion, $appliedPromotions);
        }
    }

    protected function applyActions(ApplyPromotionRequest $applyPromotionRequest): array
    {
        $appliedPromotions = [];
        $promotion = $applyPromotionRequest->getPromotion();

        foreach ($promotion->getPromotionActions() as $action) {
            $result = $this
                ->getActionCommandfor($action)
                ->execute($applyPromotionRequest->getSubject(), (array)$action->getConfiguration(), $promotion);
            if ($result) {
                $appliedPromotions[] = $action;
            }
        }
        return $appliedPromotions;
    }

    /**
     * @param ApplyPromotionRequest $applyPromotionRequest
     * @return void
     */
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

    protected function getActionCommandFor(PromotionActionInterface $promotionAction): PromotionActionCommandInterface
    {
        return $this->actionService->forAction($promotionAction);
    }
}
