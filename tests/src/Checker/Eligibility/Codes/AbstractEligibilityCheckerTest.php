<?php

namespace Marktic\Promotion\Tests\Checker\Eligibility\Codes;

use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Tests\Fixtures\Application\Models\PromotionSubjects\PromotionSubject;

abstract class AbstractEligibilityCheckerTest extends AbstractTest
{
    protected function assertChecker($code, $result)
    {
        $subject = new PromotionSubject();
        $checker = $this->generateChecker();

        self::assertSame($result, $checker->isEligible($subject, $code)->isEligible());
    }

    protected function generateChecker()
    {
        $class = $this->checkerClass();
        return new $class();
    }

    abstract protected function checkerClass(): string;

}