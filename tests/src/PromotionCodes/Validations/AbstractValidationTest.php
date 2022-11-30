<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionCodes\Validations;

use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeValidation;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects\PromotionSubject;

abstract class AbstractValidationTest extends AbstractTest
{
    protected function assertChecker(\Marktic\Promotion\PromotionCodes\Models\PromotionCode $code, bool $result): void
    {
        $subject = new PromotionSubject();
        $checker = $this->generateChecker();

        self::assertSame($result, $checker->validate($subject, $code)->isValid());
    }

    protected function generateChecker(): PromotionCodeValidation
    {
        $class = $this->checkerClass();

        return new $class();
    }

    abstract protected function checkerClass(): string;
}
