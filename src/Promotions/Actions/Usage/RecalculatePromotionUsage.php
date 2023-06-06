<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Actions\Usage;

use Marktic\Promotion\Promotions\Models\PromotionInterface;

class RecalculatePromotionUsage
{
    protected PromotionInterface $promotion;

    public function __construct($promotion)
    {
        $this->promotion = $promotion;
    }

    public static function for($promotion): self
    {
        return new self($promotion);
    }

    public function handle(): void
    {
        $sessions = $this->promotion->getPromotionSessions();
        $this->promotion->setUsed($sessions->count());
        $this->promotion->save();
    }
}

