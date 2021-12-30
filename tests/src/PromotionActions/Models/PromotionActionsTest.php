<?php

namespace Marktic\Promotion\Tests\PromotionActions\Models;

use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\Tests\Base\Models\AbstractRepositoryTest;

class PromotionActionsTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionActions::class;
    }
}
