<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator\DataObjects;

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;

class ApplyPromotionRequest extends AbstractPromotionRequest
{
    protected array $appliedActions = [];

    /**
     * @return PromotionActionInterface[]|PromotionAction[]
     */
    public function getAppliedActions(): array
    {
        return $this->appliedActions;
    }

    public function setAppliedActions(array $appliedActions): void
    {
        $this->appliedActions = $appliedActions;
    }

    public function addAppliedAction(PromotionActionInterface $action): void
    {
        $this->appliedActions[] = $action;
    }
}
