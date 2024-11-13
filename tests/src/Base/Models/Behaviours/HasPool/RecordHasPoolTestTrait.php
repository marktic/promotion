<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Base\Models\Behaviours\HasPool;

use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Nip\Records\Record;

trait RecordHasPoolTestTrait
{
    public function test_getSetPool(): void
    {
        /** @var Record|RecordHasPool $record */
        $record = $this->newRecordInstance();
        static::assertNull($record->getPool());
        static::assertNull($record->getPoolId());

        $record->setPool('test');
        static::assertSame('test', $record->getPool());

        $record->setPoolId(1);
        static::assertSame(1, $record->getPoolId());
    }
}

