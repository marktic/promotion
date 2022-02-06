<?php

namespace Marktic\Promotion\Tests\PromotionActions\Commands;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\PromotionActions\Commands\DiscountActionCommand;
use Marktic\Promotion\Tests\AbstractTest;

abstract class AbstractDiscountActionCommandTest extends AbstractTest
{

    protected function describeConfigurationOutputs($config = [], $output = '')
    {
        $configuration = new ModelConfiguration($config);
        $command = $this->newCommand();
        self::assertSame($output, $command->describeConfiguration($configuration));
    }

    /**
     * @return DiscountActionCommand
     */
    protected function newCommand()
    {
        $class = $this->commandName();
        return new $class();
    }

    abstract protected function commandName(): string;
}