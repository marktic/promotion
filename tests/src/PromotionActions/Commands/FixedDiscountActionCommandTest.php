<?php

namespace Marktic\Promotion\Tests\PromotionActions\Commands;

use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;

class FixedDiscountActionCommandTest extends AbstractDiscountActionCommandTest
{

    public function test_describeConfiguration()
    {
        $this->describeConfigurationOutputs(
            ['amount' => 10, 'amount_c' => ['EUR' => 13, 'RON' => 14]],
            'Base: -10 | EUR: -13 | RON: -14'
        );
    }

    protected function commandName(): string
    {
        return FixedDiscountActionCommand::class;
    }
}
