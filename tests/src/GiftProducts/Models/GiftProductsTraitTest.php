<?php

namespace Marktic\Promotion\Tests\GiftProducts\Models;

use Marktic\Promotion\GiftProducts\Models\Filters\FilterManager;
use Marktic\Promotion\GiftProducts\Models\GiftProducts;
use PHPUnit\Framework\TestCase;

class GiftProductsTraitTest extends TestCase
{
    public function test_filter_manager()
    {
        $repository = new GiftProducts();
        $filterManager = $repository->getFilterManager();
        self::assertInstanceOf(FilterManager::class, $filterManager);
    }
}
