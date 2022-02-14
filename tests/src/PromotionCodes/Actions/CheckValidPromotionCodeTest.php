<?php

namespace Marktic\Promotion\Tests\PromotionCodes\Actions;

use Marktic\Promotion\PromotionCodes\Actions\FindAndValidatePromotionCode;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects\PromotionSubject;
use Mockery;

/**
 *
 */
class CheckValidPromotionCodeTest extends AbstractTest
{
    /** @test */
    public function should_throw_error_if_code_not_found()
    {
        self::expectException(InvalidPromotionalCode::class);

        $promotionCode = '12345';

        $promotionCodeRepository = Mockery::mock(PromotionCodes::class)
            ->shouldAllowMockingProtectedMethods()->makePartial();
        $promotionCodeRepository
            ->shouldReceive('findOneByCode')->with($promotionCode)->andReturn(null);

        $subject = new PromotionSubject();

        $action = new FindAndValidatePromotionCode($promotionCodeRepository);
        $action->execute($subject, $promotionCode);
    }
}