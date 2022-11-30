<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Generator\Codes;

use Marktic\Promotion\PromotionCodes\Generator\Instruction\CodeGeneratorInstructionInterface;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodesRepositoryInterface;
use Marktic\Promotion\Utility\PromotionModels;

class UniqueCodeGenerator
{
    protected PromotionCodesRepositoryInterface $repository;
    protected CodeGeneratorInstructionInterface $instruction;
    protected $count = 0;
    protected $codes = null;
    protected $existing = [];

    /**
     * @param PromotionCodesRepositoryInterface $repository
     */
    public function __construct(PromotionCodesRepositoryInterface $repository = null)
    {
        $this->repository = $repository ?? PromotionModels::promotionCodes();
    }


    public static function oneFor(CodeGeneratorInstructionInterface $instruction): string
    {
        $codes = static::generate($instruction, 1);
        return current($codes);
    }

    public static function manyFor(CodeGeneratorInstructionInterface $instruction, int $count = 1): array
    {
        return static::generate($instruction, $count);
    }

    protected static function generate(CodeGeneratorInstructionInterface $instruction, int $count = 1)
    {
        $self = new self();
        $self->instruction = $instruction;
        return $self->generateCodes($count);
    }

    /**
     * @param CodeGeneratorInstructionInterface $instruction
     */
    public function setInstruction(CodeGeneratorInstructionInterface $instruction): void
    {
        $this->instruction = $instruction;
    }

    public function generateCodes(int $count): array
    {
        $this->codes = [];
        $remaining = $count;
        while ($remaining > 0) {
            $rawCodes = $this->generateRawCodes($remaining + 3);
            $rawCodes = $this->eliminateExistingCodes($rawCodes);
            $this->codes = array_merge($this->codes, $rawCodes);
            $remaining = $count - count($this->codes);
        }
        return array_splice($this->codes, 0, $count);
    }

    protected function eliminateExistingCodes($codes): array
    {
        $existingCodes = $this->findExistingCodes($codes);

        $this->existing = array_merge($this->existing, $existingCodes);
        return array_diff($codes, $this->existing, $this->codes);
    }

    protected function findExistingCodes($codes)
    {
        $existingRecords = $this->repository->findByField('code', $codes);
        return $existingRecords->pluck('code')->toArray();
    }

    protected function generateRawCodes(int $count)
    {
        $codes = [];
        while (count($codes) < $count) {
            $codes[] = $this->generateUniqueCode();
        }
        return $codes;
    }

    protected function generateUniqueCode(): string
    {
        $hash = bin2hex(random_bytes(20));

        return $this->instruction->getPrefix()
            . strtoupper(substr($hash, 0, $this->instruction->getCodeLength()))
            . $this->instruction->getSuffix();
    }
}