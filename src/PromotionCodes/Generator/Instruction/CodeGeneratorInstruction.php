<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Generator\Instruction;

class CodeGeneratorInstruction implements CodeGeneratorInstructionInterface
{
    protected ?string $prefix = null;

    protected ?int $codeLength = 8;

    protected ?string $suffix = null;

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getCodeLength(): ?int
    {
        return $this->codeLength;
    }

    public function setCodeLength(?int $codeLength): void
    {
        $this->codeLength = $codeLength;
    }

    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    public function setSuffix(?string $suffix): void
    {
        $this->suffix = $suffix;
    }
}
