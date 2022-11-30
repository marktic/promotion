<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionActions\Commands;

use Marktic\Promotion\PromotionActions\Commands\PercentageDiscountActionCommand;

class PercentageDiscountActionCommandTest extends AbstractDiscountActionCommandTest
{
    public function testDescribeConfiguration(): void
    {
        $this->describeConfigurationOutputs(
            ['amount' => 10, 'amount_c' => ['EUR' => 13, 'RON' => 14]],
            'Base: -10% | EUR: -13% | RON: -14%'
        );
    }

    protected function commandName(): string
    {
        return PercentageDiscountActionCommand::class;
    }
}
