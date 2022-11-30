<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasRules;

use Marktic\Promotion\PromotionRules\Models\PromotionRule;
use Nip\Records\Collections\Collection;

interface HasRulesInterface
{
    /**
     * @return PromotionRule[]|Collection
     */
    public function getPromotionRules();

    public function setPromotionRules($rules);

    public function hasPromotionRules(): bool;
}
