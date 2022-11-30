<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Generator\Instruction;

interface CodeGeneratorInstructionInterface
{
    public function getPrefix(): ?string;

    public function setPrefix(?string $prefix): void;

    public function getCodeLength(): ?int;

    public function setCodeLength(?int $codeLength): void;

    public function getSuffix(): ?string;

    public function setSuffix(?string $suffix): void;
}
