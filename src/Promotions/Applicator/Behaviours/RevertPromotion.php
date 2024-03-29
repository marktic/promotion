<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator\Behaviours;

use Marktic\Promotion\Promotions\Applicator\DataObjects\RevertPromotionRequest;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSessions\Models\PromotionSession;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

trait RevertPromotion
{
    public function revertFor(PromotionSubjectInterface $subject, PromotionInterface $promotion): void
    {
        $request = $this->createRequest(RevertPromotionRequest::class, $subject, $promotion);
        $this->revert($request);
    }

    public function revert(RevertPromotionRequest $applyPromotionRequest): void
    {
        $requests = $this->unpackRequest($applyPromotionRequest);
        foreach ($requests as $request) {
            $this->revertActions($request);
            $this->revertPromotion($request);
        }
    }

    protected function revertActions(RevertPromotionRequest $applyPromotionRequest): void
    {
        $promotion = $applyPromotionRequest->getPromotion();

        foreach ($promotion->getPromotionActions() as $action) {
            $this
                ->getActionCommandfor($action)
                ->revert($applyPromotionRequest->getSubject(), (array) $action->getConfiguration(), $promotion);
        }
    }

    protected function revertPromotion(RevertPromotionRequest $applyPromotionRequest): void
    {
        $this->revertPromotionSessions($applyPromotionRequest);
        $this->revertPromotionCount($applyPromotionRequest);
        $this->revertPromotionCode($applyPromotionRequest);
    }

    protected function revertPromotionSessions(RevertPromotionRequest $applyPromotionRequest): void
    {
        $subject = $applyPromotionRequest->getSubject();
        $promotionSessions = $subject->getPromotionSessions();
        foreach ($promotionSessions as $promotionSession) {
            if ($promotionSession->promotion_id === $applyPromotionRequest->getPromotion()->id) {
                $promotionSessions->remove($promotionSession);
                $promotionSession->delete();
            }
        }
    }

    protected function revertPromotionCount(RevertPromotionRequest $applyPromotionRequest): void
    {
        $promotion = $applyPromotionRequest->getPromotion();
        $promotion->decrementUsed();
        $promotion->save();
    }

    protected function revertPromotionCode(RevertPromotionRequest $applyPromotionRequest): void
    {
        if ($applyPromotionRequest->hasPromotionCode()) {
            $promotionCode = $applyPromotionRequest->getPromotionCode();
            $promotionCode->decrementUsed();
            $promotionCode->save();
        }
    }
}
