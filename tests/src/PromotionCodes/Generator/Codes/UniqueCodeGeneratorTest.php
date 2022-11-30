<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\PromotionCodes\Generator\Codes;

use Marktic\Promotion\PromotionCodes\Generator\Codes\UniqueCodeGenerator;
use Marktic\Promotion\PromotionCodes\Generator\Instruction\CodeGeneratorInstruction;
use PHPUnit\Framework\TestCase;

class UniqueCodeGeneratorTest extends TestCase
{
    public function testGenerateMany()
    {
        $generator = \Mockery::mock(UniqueCodeGenerator::class)->makePartial();
        $generator->shouldAllowMockingProtectedMethods();
        $generator->shouldReceive('findExistingCodes')->andReturn(['existing']);

        $instruction = CodeGeneratorInstruction::default();
        $generator->setInstruction($instruction);

        $codes = $generator->generateCodes(10);
        static::assertCount(10, $codes);

        foreach ($codes as $code) {
            static::assertIsString($code);
            static::assertSame($instruction->getCodeLength(), \strlen($code));
        }
    }

    public function testGeneratWithExisting()
    {
        $generator = \Mockery::mock(UniqueCodeGenerator::class)->makePartial();
        $generator->shouldAllowMockingProtectedMethods();
        $generator->shouldReceive('findExistingCodes')->andReturn(['A1', 'A2', 'A5', 'A6'], []);
        $generator->shouldReceive('generateUniqueCode')
            ->andReturn('A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10', 'A11');

        $instruction = CodeGeneratorInstruction::default();
        $generator->setInstruction($instruction);

        $codes = $generator->generateCodes(4);
        static::assertCount(4, $codes);

        self::assertSame(['A3', 'A4', 'A7', 'A8'], $codes);
    }
}
