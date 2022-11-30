<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionSubjects\Actions\PromotionCodes;

use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\Bundle\Models\PromotionCodes\PromotionCode;
use Marktic\Promotion\CartPromotions\Actions\RunPromotionValidations;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionCodes\Actions\FindAndValidatePromotionCode;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionSubjects\Actions\ApplyPromotion;
use Marktic\Promotion\PromotionSubjects\Actions\PromotionCodes\RedeemPromotionCode;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects\PromotionSubject;

class RedeemPromotionCodeTest extends AbstractTest
{
    public function testInvalidPromotionsThrowsException(): void
    {
        $promotion = new CartPromotion();

        $promotionCode = \Mockery::mock(PromotionCode::class)->makePartial();
        $promotionCode->shouldReceive('getPromotion')->andReturn($promotion);

        $promotionCodeValidations = \Mockery::mock(FindAndValidatePromotionCode::class)->makePartial();
        $promotionCodeValidations->shouldReceive('execute')->once()->andReturn($promotionCode);

        $promotionValidations = \Mockery::mock(RunPromotionValidations::class)->makePartial();
        $promotionValidations->shouldReceive('execute')->once()->andReturn(ValidationResult::invalid('invalid'));

        $applyPromotion = \Mockery::mock(ApplyPromotion::class)->makePartial();

        $redeemPromotionCode = new RedeemPromotionCode(
            $promotionCodeValidations,
            $promotionValidations,
            $applyPromotion
        );

        static::expectException(InvalidPromotionalCode::class);
        static::expectExceptionMessage('invalid');

        $redeemPromotionCode->for(new PromotionSubject(), '999');
    }
}
