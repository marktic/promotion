<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator\DataObjects;

use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class AbstractPromotionRequest
{
    protected PromotionSubjectInterface $subject;

    protected PromotionInterface $promotion;

    protected ?PromotionCodeInterface $promotionCode = null;

    public static function create(): static
    {
        return new static();
    }

    public function getSubject(): PromotionSubjectInterface
    {
        return $this->subject;
    }

    public function setSubject(PromotionSubjectInterface $subject): void
    {
        $this->subject = $subject;
    }

    public function getPromotion(): PromotionInterface
    {
        return $this->promotion;
    }

    public function setPromotion(PromotionInterface $promotion): void
    {
        $this->promotion = $promotion;
    }

    public function getPromotionCode(): ?PromotionCodeInterface
    {
        return $this->promotionCode;
    }

    public function setPromotionCode(PromotionCodeInterface $promotionCode): void
    {
        $this->promotionCode = $promotionCode;
    }

    public function hasPromotionCode(): bool
    {
        return null !== $this->promotionCode;
    }
}
