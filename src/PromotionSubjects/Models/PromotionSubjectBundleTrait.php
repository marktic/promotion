<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Models;

use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Collections\Collection;

trait PromotionSubjectBundleTrait
{
    abstract public function getPromotionSubjects(): Collection;

    public function getPromotionSubjectCount(): int
    {
        return \count($this->getPromotionSubjects());
    }

    public function getPromotions(): Collection
    {
        $promotions = PromotionModels::promotions()->newCollection();
        $items = $this->getPromotionSubjects();
        foreach ($items as $item) {
            $item->getPromotions()->each(function ($promotion) use ($promotions) {
                $promotions->add($promotion);
            });
        }

        return $promotions;
    }

    public function getPromotionSessions(): Collection
    {
        $sessions = PromotionModels::promotionSessions()->newCollection();
        $items = $this->getPromotionSubjects();
        foreach ($items as $item) {
            $item->getPromotionSessions()->each(function ($session) use ($sessions) {
                $sessions->add($session);
            });
        }

        return $sessions;
    }
}
