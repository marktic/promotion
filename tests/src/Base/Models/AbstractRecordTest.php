<?php

namespace Marktic\Promotion\Tests\Base\Models;

use Marktic\Promotion\Tests\AbstractTest;
use Nip\Records\AbstractModels\Record;

abstract class AbstractRecordTest extends AbstractTest
{
    protected function newRecordInstance(): Record
    {
        $class = $this->getRecordClass();
        $record = new $class();
        return $record;
    }

    abstract protected function getRecordClass(): string;
}
