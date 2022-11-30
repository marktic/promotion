<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasActions;

use Marktic\Promotion\PromotionRules\Models\PromotionRule;
use Nip\Records\Collections\Collection;

interface HasActionsInterface
{
    /**
     * @return PromotionRule[]|Collection
     */
    public function getPromotionActions();

    public function setPromotionActions($actions);

    public function hasPromotionActions(): bool;
}
