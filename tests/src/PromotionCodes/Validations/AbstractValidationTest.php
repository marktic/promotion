<?php

namespace Marktic\Promotion\Tests\PromotionCodes\Validations;

use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeValidationInterface;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects\PromotionSubject;

abstract class AbstractValidationTest extends AbstractTest
{
    protected function assertChecker($code, $result)
    {
        $subject = new PromotionSubject();
        $checker = $this->generateChecker();

        self::assertSame($result, $checker->isEligible($subject, $code)->isValid());
    }

    protected function generateChecker(): PromotionCodeValidationInterface
    {
        $class = $this->checkerClass();
        return new $class();
    }

    abstract protected function checkerClass(): string;

}