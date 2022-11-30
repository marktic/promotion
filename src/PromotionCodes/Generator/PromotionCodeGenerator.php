<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Generator;

use Marktic\Promotion\PromotionCodes\Generator\Instruction\CodeGeneratorInstruction;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodesRepositoryInterface;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Collections\Collection;

class PromotionCodeGenerator
{
    protected PromotionCodesRepositoryInterface $repository;

    public function __construct(PromotionCodesRepositoryInterface $repository = null)
    {
        $this->repository = $repository ?? PromotionModels::promotionCodes();
    }

    public function generateOne(CodeGeneratorInstruction $instructions): Record|PromotionCodeInterface
    {
        return $this->repository->getNewRecord();
    }

    public function generateMany(CodeGeneratorInstruction $instructions, int $count = 1): Collection
    {
        return $this->repository->newCollection();
    }
}
