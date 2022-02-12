<?php

namespace Marktic\Promotion\Tests\Checker\Eligibility\Codes;

use DateInterval;
use DateTime;
use Marktic\Promotion\Checker\Eligibility\Codes\PromotionCodeDurationLimitEligibilityChecker;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;

class PromotionCodeDurationLimitEligibilityCheckerTest extends AbstractEligibilityCheckerTest
{
    /**
     * @test
     */
    public function code_with_null_dates_is_eligible()
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
        if ($days === null) {
            return null;
        }

        $now = new DateTime();
        $interval = new DateInterval('P' . abs($days) . 'D');
        if ($days < 0) {
            $now = $now->sub($interval);
        } else {
            $now = $now->add($interval);
        }
        return $now->format('Y-m-d');
    }


    /**
     * @test
     */
    public function code_with_null_start_is_eligible()
    {
        $code = $this->generateCode(null, 4);
        $this->assertChecker($code, true);
    }

    /**
     * @test
     */
    public function code_with_past_start_is_eligible()
    {
        $code = $this->generateCode(-1, 4);
        $this->assertChecker($code, true);
    }

    /**
     * @test
     */
    public function code_with_future_to_is_not_eligible()
    {
        $code = $this->generateCode(1, 4);
        $this->assertChecker($code, false);
    }

    /**
     * @test
     */
    public function code_with_null_end_is_eligible()
    {
        $code = $this->generateCode(-1);
        $this->assertChecker($code, true);
    }

    /**
     * @test
     */
    public function code_with_past_end_is_not_eligible()
    {
        $code = $this->generateCode(-3, -1);
        $this->assertChecker($code, false);
    }

    /**
     * @test
     */
    public function code_with_future_end_is_eligible()
    {
        $code = $this->generateCode(-1, 4);
        $this->assertChecker($code, true);
    }

    protected function checkerClass(): string
    {
        return PromotionCodeDurationLimitEligibilityChecker::class;
    }
}
