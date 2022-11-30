<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Factories;

use Marktic\Promotion\PromotionActions\Commands\PromotionActionCommandInterface;

interface PromotionActionCommandFactoryInterface
{
    public function create(string $type): PromotionActionCommandInterface;
}
