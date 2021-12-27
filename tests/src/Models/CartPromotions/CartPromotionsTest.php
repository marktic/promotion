<?php

namespace Marktic\Promotion\Tests\Models\CartPromotions;

use Marktic\Promotion\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class CartPromotionsTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return CartPromotions::class;
    }
}
