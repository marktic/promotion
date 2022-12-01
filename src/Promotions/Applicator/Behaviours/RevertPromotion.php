<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator\Behaviours;

use Marktic\Promotion\Promotions\Applicator\DataObjects\RevertPromotionRequest;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

trait RevertPromotion
{
    public function revertFor(PromotionSubjectInterface $subject, PromotionInterface $promotion)
    {
        $request = RevertPromotionRequest::create();
        $request->setSubject($subject);
        $request->setPromotion($promotion);
        $this->revert($request);
    }

    public function revert(RevertPromotionRequest $applyPromotionRequest): void
    {
        $this->revertActions($applyPromotionRequest);
        $this->revertPromotion($applyPromotionRequest);
    }

    protected function revertActions(RevertPromotionRequest $applyPromotionRequest): void
    {
        $promotion = $applyPromotionRequest->getPromotion();

        foreach ($promotion->getPromotionActions() as $action) {
            $this
                ->getActionCommandfor($action)
                ->revert($applyPromotionRequest->getSubject(), (array)$action->getConfiguration(), $promotion);
        }
    }

    protected function revertPromotion(RevertPromotionRequest $applyPromotionRequest): void
    {
        $promotion = $applyPromotionRequest->getPromotion();
        $promotion->decrementUsed();
        $promotion->save();

        if ($applyPromotionRequest->hasPromotionCode()) {
            $promotionCode = $applyPromotionRequest->getPromotionCode();
            $promotionCode->decrementUsed();
            $promotionCode->save();
        }
    }
}
