<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionCodes\Validations;

use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeValidationDurationLimitValidation;

class PromotionCodeDurationLimitValidationTest extends AbstractValidationTest
{
    public function testCodeWithNullDatesIsEligible()
    {
        $code = $this->generateCode();
        $this->assertChecker($code, true);
    }

    protected function generateCode($from = null, $to = null): PromotionCode
    {
        $code = new PromotionCode();

        $code->fill([
            'valid_from' => $this->generateDate($from),
            'valid_to' => $this->generateDate($to),
        ]);

        return $code;
    }

    protected function generateDate($days = null): ?string
    {
        if (null === $days) {
            return null;
        }

        $now = new \DateTime();
        $interval = new \DateInterval('P' . abs($days) . 'D');
        if ($days < 0) {
            $now = $now->sub($interval);
        } else {
            $now = $now->add($interval);
        }

        return $now->format('Y-m-d');
    }

    public function testCodeWithNullStartIsEligible()
    {
        $code = $this->generateCode(null, 4);
        $this->assertChecker($code, true);
    }

    public function testCodeWithPastStartIsEligible()
    {
        $code = $this->generateCode(-1, 4);
        $this->assertChecker($code, true);
    }

    public function testCodeWithFutureToIsNotEligible()
    {
        $code = $this->generateCode(1, 4);
        $this->assertChecker($code, false);
    }

    public function testCodeWithNullEndIsEligible()
    {
        $code = $this->generateCode(-1);
        $this->assertChecker($code, true);
    }

    public function testCodeWithPastEndIsNotEligible()
    {
        $code = $this->generateCode(-3, -1);
        $this->assertChecker($code, false);
    }

    public function testCodeWithFutureEndIsEligible()
    {
        $code = $this->generateCode(-1, 4);
        $this->assertChecker($code, true);
    }

    protected function checkerClass(): string
    {
        return PromotionCodeValidationDurationLimitValidation::class;
    }
}
