<?php

namespace Marktic\Promotion\Tests\Base\Models\Behaviours\HasConfiguration;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Nip\Records\AbstractModels\Record;

trait RecordHasConfigurationTestTrait
{
    /**
     * @dataProvider data_getConfiguration
     */
    public function test_getConfiguration($input, $expected)
    {
        /** @var Record|RecordHasConfiguration $record */
        $record = $this->newRecordInstance();
        $record->fill(['configuration' => $input]);

        $configuration = $record->getConfiguration();
        self::assertInstanceOf(ModelConfiguration::class, $configuration);
        self::assertSame($expected, $configuration->toArray());
    }

    abstract protected function newRecordInstance(): Record;

    public function data_getConfiguration()
    {
        return [
            [null, []],
            ['{}', []],
            ['{"foo":"bar"}', ['foo' => 'bar']],
            ['{"foo":"bar","bar":"foo"}', ['foo' => 'bar', 'bar' => 'foo']],
        ];
    }

    public function test_setConfiguration()
    {
        /** @var Record|RecordHasConfiguration $record */
        $record = $this->newRecordInstance();

        $record->setConfiguration(['foo' => 'bar']);
        $configuration = $record->getConfiguration();
        self::assertInstanceOf(ModelConfiguration::class, $configuration);
        self::assertSame(['foo' => 'bar'], $configuration->toArray());
        self::assertSame('{"foo":"bar"}', $record->getPropertyRaw('configuration'));

        $configuration->set('bar', 'foo');
        $configuration = $record->getConfiguration();
        self::assertSame('{"foo":"bar","bar":"foo"}', $record->getPropertyRaw('configuration'));
        self::assertSame(['foo' => 'bar', 'bar' => 'foo'], $configuration->toArray());
    }
}
