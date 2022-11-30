<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionActions\Models;

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasConfiguration\RecordHasConfigurationTestTrait;

class PromotionActionTest extends AbstractRecordTest
{
    use RecordHasConfigurationTestTrait;

    protected function getRecordClass(): string
    {
        return PromotionAction::class;
    }
}
