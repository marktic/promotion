<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSessions\Actions;

use Marktic\Promotion\Promotions\Applicator\DataObjects\ApplyPromotionRequest;
use Marktic\Promotion\PromotionSessions\Models\PromotionSession;
use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Marktic\Promotion\Utility\PromotionModels;

class CreateSessionForPromotionApplication
{
    protected PromotionSessions $promotionSessionRepository;

    /**
     * @param PromotionSessions $promotionSessionRepository
     */
    public function __construct(?PromotionSessions $promotionSessionRepository = null)
    {
        $this->promotionSessionRepository = $promotionSessionRepository ?? PromotionModels::promotionSessions();
    }

    public function createForRequest(ApplyPromotionRequest $request): PromotionSession
    {
        $session = $this->promotionSessionRepository->getNew();
        $session->populateFromSubject($request->getSubject());
        $session->populateFromPromotion($request->getPromotion());
        $session->setAppliedActions($request->getAppliedActions());
        if ($request->hasPromotionCode()) {
            $session->setPromotionCode($request->getPromotionCode());
        }

        $session->save();

        return $session;
    }
}
