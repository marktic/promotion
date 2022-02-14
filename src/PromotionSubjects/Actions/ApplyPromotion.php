<?php

namespace Marktic\Promotion\PromotionSubjects\Actions;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ApplyPromotion
{
    protected $registry = [];

    public function apply(PromotionSubjectInterface $subject, PromotionInterface $promotion)
    {
        $applyPromotion = false;

        foreach ($promotion->getPromotionActions() as $action) {
            $result = $this
                ->getActionCommandByType($action->getType())
                ->execute($subject, (array)$action->getConfiguration(), $promotion);
            $applyPromotion = $applyPromotion || $result;
        }

        if ($applyPromotion) {
            $subject->addPromotion($promotion);
        }
    }

    protected function getActionCommandByType(string $type): PromotionActionCommandInterface
    {
        return $this->registry->get($type);
    }
}
