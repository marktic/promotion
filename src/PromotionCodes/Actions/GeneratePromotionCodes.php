<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Actions;

use Marktic\Promotion\PromotionCodes\Generator\Codes\UniqueCodeGenerator;
use Marktic\Promotion\PromotionCodes\Generator\Instruction\CodeGeneratorInstruction;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\Utility\PromotionModels;

class GeneratePromotionCodes
{
    protected PromotionInterface $promotion;

    protected int $count = 1;

    protected string $format = '{code}';

    protected int $length = 8;

    public function __construct(PromotionInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    public static function for(PromotionInterface $promotion): self
    {
        return new self($promotion);
    }

    public function withCount(int $count): self
    {
        $this->count = max(1, min(1000, $count));

        return $this;
    }

    public function withFormat(string $format): self
    {
        $this->format = '' === $format ? '{code}' : $format;

        return $this;
    }

    public function withLength(int $length): self
    {
        $this->length = max(1, min(64, $length));

        return $this;
    }

    public function handle(): int
    {
        [$prefix, $suffix] = $this->extractCodePattern($this->format);

        $instruction = CodeGeneratorInstruction::default();
        $instruction->setCodeLength($this->length);
        $instruction->setPrefix($prefix);
        $instruction->setSuffix($suffix);

        $codes = UniqueCodeGenerator::manyFor($instruction, $this->count);
        foreach ($codes as $generatedCode) {
            $code = PromotionModels::promotionCodes()->getNew();
            $code->populateFromPromotion($this->promotion);
            $code->setCode($generatedCode);
            $code->setUsageLimit($this->promotion->getUsageLimit());
            $code->setUsed(0);
            $code->setValidFrom($this->promotion->getValidFrom());
            $code->setValidTo($this->promotion->getValidTo());
            $code->save();
        }

        return count($codes);
    }

    protected function extractCodePattern(string $format): array
    {
        $placeholder = '{code}';
        $position = strpos($format, $placeholder);
        if (false === $position) {
            return [$format, null];
        }

        $prefix = substr($format, 0, $position);
        $suffix = substr($format, $position + strlen($placeholder));

        return [$prefix, $suffix];
    }
}
