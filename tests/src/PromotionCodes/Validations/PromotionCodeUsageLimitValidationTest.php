<?php

namespace Marktic\Promotion\Tests\PromotionCodes\Validations;

use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeValidationUsageLimitValidation;

class PromotionCodeUsageLimitValidationTest extends AbstractValidationTest
{
    /**
     * @test
     * @dataProvider data_is_eligible
     */
    public function code_is_eligible()
    {
        $code = $this->generateCode(null, null);
        $this->assertChecker($code, true);
    }

    protected function generateCode($used = null, $limit = 10): PromotionCode
    {
        $code = new PromotionCode();

        $code->fill([
            'used' => $used,
            'usage_limit' => $limit,
        ]);

        return $code;
    }

    public function data_is_eligible(): array
    {
        return [
            [null, null, true],
            ['', '', true],
            [null, 9, true],
            ['', 9, true],
            [9, null, true],
            [9, 10, true],
            [9, 9, false],
            [10, 9, false],
        ];
    }

    protected function checkerClass(): string
    {
        return PromotionCodeValidationUsageLimitValidation::class;
    }
}
