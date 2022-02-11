<?php

namespace Marktic\Promotion\CartPromotions\Actions;

use Marktic\Promotion\Base\Models\PromotionInterface;
use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ApplyPromotion
{
    protected $registry = [];

    public function apply(PromotionSubjectInterface $subject, PromotionInterface $promotion)
    {
        $applyPromotion = false;

        foreach ($promotion->getActions() as $action) {
            $result = $this
                ->getActionCommandByType($action->getType())
                ->execute($subject, $action->getConfiguration(), $promotion);
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
