<?php

namespace Marktic\Promotion\Tests\Models\CartPromotions;

use Marktic\Promotion\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class PromotionActionsTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionActions::class;
    }
}
