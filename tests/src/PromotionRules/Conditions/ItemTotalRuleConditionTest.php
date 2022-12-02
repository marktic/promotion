<?php

namespace Marktic\Promotion\Tests\PromotionRules\Conditions;

use Marktic\Promotion\PromotionRules\Conditions\ItemTotalRuleCondition;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use PHPUnit\Framework\TestCase;

class ItemTotalRuleConditionTest extends TestCase
{
    /**
     * @param $amount
     * @param $config
     * @param $resultBool
     * @return void
     * @dataProvider data_validate
     */
    public function test_validate($amount, $config, $resultBool)
    {
        $condition = new ItemTotalRuleCondition();
        $subject = $this->createMock(PromotionSubjectInterface::class);
        $subject->expects($this->once())->method('getPromotionSubjectTotal')->willReturn($amount);
        $result = $condition->validate($subject, $config);
        self::assertSame($resultBool, $result->isValid());
    }

    public function data_validate(): array
    {
        $return = [];
        // NO CONDITIONS
        $return[] = [
            10.00,
            [],
            true,
        ];
        // ONLY MIN AMOUNT
        $return[] = [
            10.00,
            [ItemTotalRuleCondition::CONF_MIN_AMOUNT => 10.00],
            true,
        ];
        // ONLY MIN AMOUNT
        $return[] = [
            10.00,
            [ItemTotalRuleCondition::CONF_MIN_AMOUNT => 11.00],
            false,
        ];
        // ONLY MAX AMOUNT
        $return[] = [
            10.00,
            [ItemTotalRuleCondition::CONF_MAX_AMOUNT => 10.00],
            true,
        ];
        // ONLY MAX AMOUNT
        $return[] = [
            10.00,
            [ItemTotalRuleCondition::CONF_MAX_AMOUNT => 9.00],
            false,
        ];
        // BOTH LIMIT VALID
        $return[] = [
            11.00,
            [ItemTotalRuleCondition::CONF_MIN_AMOUNT => 10.00, ItemTotalRuleCondition::CONF_MAX_AMOUNT => 20.00],
            true,
        ];
        // BOTH LIMIT INVALID
        $return[] = [
            9.00,
            [ItemTotalRuleCondition::CONF_MIN_AMOUNT => 10.00, ItemTotalRuleCondition::CONF_MAX_AMOUNT => 20.00],
            false,
        ];
        return $return;
    }
}
