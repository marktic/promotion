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
    public const MIN_LENGTH = 8;

    protected PromotionCodesRepositoryInterface $repository;

    /**
     * @param PromotionCodesRepositoryInterface $repository
     */
    public function __construct(PromotionCodesRepositoryInterface $repository)
    {
        $this->repository = $repository ?? PromotionModels::promotionCodes();
    }

    public function generateUniqueCode(CodeGeneratorInstruction $instruction): string
    {
        $code = $this->generateCode($instruction);
        while ($this->repository->findOneByCode($code)) {
            $code = $this->generateCode($instruction);
        }

        return $code;
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

