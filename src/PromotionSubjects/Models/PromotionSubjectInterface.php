<?php

namespace Marktic\Promotion\PromotionSubjects\Models;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Nip\Records\Collections\Collection;

interface PromotionSubjectInterface
{

    public function getPromotionSubjectTotal(): float;

    /**
     * @return Collection|PromotionInterface[]
     *
     * @psalm-return Collection<array-key, PromotionInterface>
     */
    public function getPromotions(): Collection;

    public function hasPromotion(PromotionInterface $promotion): bool;

    public function addPromotion(PromotionInterface $promotion): void;

    public function removePromotion(PromotionInterface $promotion): void;
}
