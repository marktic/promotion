<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionRules\Conditions;

use Marktic\Promotion\PromotionRules\Conditions\ItemQuantityRuleCondition;
use Marktic\Promotion\PromotionSubjects\Models\CountablePromotionSubjectInterface;
use PHPUnit\Framework\TestCase;

class ItemQuantityRuleConditionTest extends TestCase
{
    /**
     * @return void
     *
     * @dataProvider data_validate
     */
    public function testValidate($value, $config, $resultBool)
    {
        $condition = new ItemQuantityRuleCondition();
        $subject = $this->createMock(CountablePromotionSubjectInterface::class);
        $subject->expects($this->once())->method('getPromotionSubjectCount')->willReturn($value);
        $result = $condition->validate($subject, $config);
        self::assertSame($resultBool, $result->isValid());
    }

    public function data_validate(): array
    {
        $return = [];
        // NO CONDITIONS
        $return[] = [
            10,
            [],
            true,
        ];
        // ONLY MIN AMOUNT
        $return[] = [
            10,
            [ItemQuantityRuleCondition::CONF_MIN_ITEMS => 10],
            true,
        ];
        // ONLY MIN AMOUNT
        $return[] = [
            10,
            [ItemQuantityRuleCondition::CONF_MIN_ITEMS => 11],
            false,
        ];
        // ONLY MAX AMOUNT
        $return[] = [
            10,
            [ItemQuantityRuleCondition::CONF_MAX_ITEMS => 10],
            true,
        ];
        // ONLY MAX AMOUNT
        $return[] = [
            10,
            [ItemQuantityRuleCondition::CONF_MAX_ITEMS => 9],
            false,
        ];
        // BOTH LIMIT VALID
        $return[] = [
            11,
            [ItemQuantityRuleCondition::CONF_MIN_ITEMS => 0, ItemQuantityRuleCondition::CONF_MAX_ITEMS => 20],
            true,
        ];
        // BOTH LIMIT INVALID
        $return[] = [
            9,
            [ItemQuantityRuleCondition::CONF_MIN_ITEMS => 10, ItemQuantityRuleCondition::CONF_MAX_ITEMS => 20],
            false,
        ];

        return $return;
    }
}
