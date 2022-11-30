<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionSessions\Models;

use Marktic\Promotion\Bundle\Models\PromotionSessions\PromotionSession;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasConfiguration\RecordHasConfigurationTestTrait;

/**
 * @method PromotionSession newRecordInstance()
 */
class PromotionSessionTest extends AbstractRecordTest
{
    use RecordHasConfigurationTestTrait;

    public function testSetAppliedActions(): void
    {
        $promotionSession = $this->newRecordInstance();
        $actions = [
            (new PromotionAction())->fill(['id' => 1, 'type' => 'test1']),
            (new PromotionAction())->fill(['id' => 2, 'type' => 'test2']),
        ];
        $promotionSession->setAppliedActions($actions);
        $this->assertEquals(
            [
                'applied_actions' => [
                    ['id' => 1, 'type' => 'test1'],
                    ['id' => 2, 'type' => 'test2'],
                ],
            ],
            $promotionSession->getConfiguration()->toArray()
        );
    }

    protected function getRecordClass(): string
    {
        return PromotionSession::class;
    }
}
