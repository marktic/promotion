<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Base\Models\Behaviours\HasValidity;

use Carbon\Carbon;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;
use Nip\Records\AbstractModels\Record;

trait RecordHasValidityTestTrait
{
    public function test_getValidCast()
    {
        /** @var Record|RecordHasValidity $record */
        $record = $this->newRecordInstance();
        self::assertNull($record->getValidFrom());
        self::assertNull($record->getValidTo());

        $record->fill(['valid_from' => null, 'valid_to' => null]);
        self::assertNull($record->getValidFrom());
        self::assertNull($record->getValidTo());

        $record->fill(['valid_from' => '', 'valid_to' => '']);
        self::assertNull($record->getValidFrom());
        self::assertNull($record->getValidTo());

        $date = '2020-03-01 01:02:03';
        $record->fill(['valid_from' => $date, 'valid_to' => $date]);
        self::assertInstanceOf(\DateTime::class, $record->getValidFrom());
        self::assertSame($date, (string) $record->getValidFrom());
        self::assertInstanceOf(\DateTime::class, $record->getValidTo());
        self::assertSame($date, (string) $record->getValidTo());
    }

    abstract protected function newRecordInstance(): Record;

    public function test_setValidity()
    {
        /** @var Record|RecordHasValidity $record */
        $record = $this->newRecordInstance();

        $date = '2020-03-01 01:02:03';

        $carbon = Carbon::parse($date);
        $record->setValidFrom($carbon);
        $record->setValidTo($carbon);

        self::assertInstanceOf(\DateTime::class, $record->getValidFrom());
        self::assertSame($date, (string) $record->getValidFrom());
        self::assertInstanceOf(\DateTime::class, $record->getValidTo());
        self::assertSame($date, (string) $record->getValidTo());

        self::assertSame([], $record->getOriginalData());
    }
}
