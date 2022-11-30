<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\DataObjects;

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

class ApplyPromotionRequest
{
    protected PromotionSubjectInterface $subject;

    protected PromotionInterface $promotion;

    protected ?PromotionCodeInterface $promotionCode = null;

    protected array $appliedActions = [];

    public static function create(): self
    {
        return new self();
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

    /**
     * @return PromotionActionInterface[]|PromotionAction[]
     */
    public function getAppliedActions(): array
    {
        return $this->appliedActions;
    }

    public function setAppliedActions(array $appliedActions): void
    {
        $this->appliedActions = $appliedActions;
    }
}
