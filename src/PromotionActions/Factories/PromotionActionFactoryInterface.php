<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Factories;

use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;

interface PromotionActionFactoryInterface
{
    public function createFixedDiscount(int $amount): PromotionActionInterface;

    public function createAmountDiscount(int $amount): PromotionActionInterface;

    public function createPercentageDiscount(float $percentage): PromotionActionInterface;

    public function create(string $type, array $configuration): PromotionActionInterface;
}
