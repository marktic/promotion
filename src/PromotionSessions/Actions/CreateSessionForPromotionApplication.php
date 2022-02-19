<?php

namespace Marktic\Promotion\PromotionSessions\Actions;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
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

    public function create(PromotionSubjectInterface $subject, PromotionInterface $promotion, $actions)
    {
        $session = $this->promotionSessionRepository->getNew();
        $session->populateFromSubject($subject);
        $session->populateFromPromotion($promotion);
        $session->setAppliedActions($actions);
        $session->save();

        return $session;
    }
}
