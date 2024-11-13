<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Base\Models\Behaviours\HasConfiguration;

use ByTIC\DataObjects\Casts\Metadata\Metadata;
use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Nip\Records\AbstractModels\Record;

trait RecordHasConfigurationTestTrait
{
    /**
     * @dataProvider data_getConfiguration
     */
    public function test_getConfiguration($input, $expected): void
    {
        /** @var Record|RecordHasConfiguration $record */
        $record = $this->newRecordInstance();
        $record->fill(['configuration' => $input]);

        $configuration = $record->getConfiguration();
        self::assertInstanceOf(Metadata::class, $configuration);
        self::assertSame($expected, $configuration->toArray());
    }

    abstract protected function newRecordInstance(): Record;

    /**
     * @return (null|string|string[])[][]
     *
     * @psalm-return array{0: array{0: null, 1: array<empty, empty>}, 1: array{0: '{}', 1: array<empty, empty>}, 2: array{0: '{"foo":"bar"}', 1: array{foo: 'bar'}}, 3: array{0: '{"foo":"bar","bar":"foo"}', 1: array{foo: 'bar', bar: 'foo'}}}
     */
    public function data_getConfiguration(): array
    {
        return [
            [null, []],
            ['{}', []],
            ['{"foo":"bar"}', ['foo' => 'bar']],
            ['{"foo":"bar","bar":"foo"}', ['foo' => 'bar', 'bar' => 'foo']],
        ];
    }

    public function test_setConfiguration(): void
    {
        /** @var Record|RecordHasConfiguration $record */
        $record = $this->newRecordInstance();

        $record->setConfiguration(['foo' => 'bar']);
        $configuration = $record->getConfiguration();
        self::assertInstanceOf(Metadata::class, $configuration);
        self::assertSame(['foo' => 'bar'], $configuration->toArray());
        self::assertSame('{"foo":"bar"}', $record->getPropertyRaw('configuration'));

        $configuration->set('bar', 'foo');
        $configuration = $record->getConfiguration();
        self::assertSame('{"foo":"bar","bar":"foo"}', $record->getPropertyRaw('configuration'));
        self::assertSame(['foo' => 'bar', 'bar' => 'foo'], $configuration->toArray());
    }
}
