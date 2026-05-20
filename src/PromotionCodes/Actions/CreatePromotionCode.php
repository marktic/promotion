<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Actions;

use Marktic\Promotion\Promotions\Models\PromotionInterface;

class CreatePromotionCode
{
    protected PromotionInterface $promotion;

    public function __construct(PromotionInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    public static function for(PromotionInterface $promotion): self
    {
        return new self($promotion);
    }

    public function handle(): void
    {
        GeneratePromotionCodes::for($this->promotion)->handle();
    }
}
