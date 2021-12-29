<?php

namespace Marktic\Promotion\Tests\Models\PromotionActions;

use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\Tests\Models\AbstractModels\AbstractRepositoryTest;

class PromotionActionsTest extends AbstractRepositoryTest
{
    protected function getRepositoryClass(): string
    {
        return PromotionActions::class;
    }
}
