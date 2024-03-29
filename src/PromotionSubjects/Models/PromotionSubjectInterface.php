<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Models;

use Marktic\Pricing\Saleable\Contracts\SaleableInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSessions\Models\PromotionSession;
use Nip\Records\Collections\Collection;

/**
 * @method Collection|PromotionSession getPromotionSessions()
 */
interface PromotionSubjectInterface extends SaleableInterface
{
    public function getId();

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
