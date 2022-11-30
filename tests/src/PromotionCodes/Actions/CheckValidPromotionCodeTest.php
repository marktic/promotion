<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionCodes\Actions;

use Marktic\Promotion\PromotionCodes\Actions\FindAndValidatePromotionCode;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects\PromotionSubject;

class CheckValidPromotionCodeTest extends AbstractTest
{
    public function testShouldThrowErrorIfCodeNotFound(): void
    {
        self::expectException(InvalidPromotionalCode::class);

        $promotionCode = '12345';

        $promotionCodeRepository = \Mockery::mock(PromotionCodes::class)
            ->shouldAllowMockingProtectedMethods()->makePartial();
        $promotionCodeRepository
            ->shouldReceive('findOneByCode')->with($promotionCode)->andReturn(null);

        $subject = new PromotionSubject();

        $action = new FindAndValidatePromotionCode($promotionCodeRepository);
        $action->execute($subject, $promotionCode);
    }
}
