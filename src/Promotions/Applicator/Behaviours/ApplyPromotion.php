<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator\Behaviours;

use Marktic\Promotion\Promotions\Applicator\DataObjects\ApplyPromotionRequest;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

trait ApplyPromotion
{
    public function applyFor(PromotionSubjectInterface $subject, PromotionInterface $promotion): void
    {
        $request = $this->createRequest(ApplyPromotionRequest::class, $subject, $promotion);
        $this->apply($request);
    }

    public function apply(ApplyPromotionRequest $applyPromotionRequest): void
    {
        $requests = $this->unpackRequest($applyPromotionRequest);

        foreach ($requests as $request) {
            $appliedActions = $this->applyActions($request);

            if (\count($appliedActions)) {
                $this->applyPromotion($request);
            }
        }
    }

    protected function applyActions(ApplyPromotionRequest $applyPromotionRequest): array
    {
        $promotion = $applyPromotionRequest->getPromotion();

        foreach ($promotion->getPromotionActions() as $action) {
            $result = $this
                ->getActionCommandfor($action)
                ->execute($applyPromotionRequest->getSubject(), (array)$action->getConfiguration(), $promotion);
            if ($result) {
                $applyPromotionRequest->addAppliedAction($action);
            }
        }

        return $applyPromotionRequest->getAppliedActions();
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
}
