<?php

namespace Marktic\Promotion\Tests\CartPromotions\Models;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class CartPromotionsTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return CartPromotions::class;
    }
}
