<?php

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

    /**
     * @return PromotionSubjectInterface
     */
    public function getSubject(): PromotionSubjectInterface
    {
        return $this->subject;
    }

    /**
     * @param PromotionSubjectInterface $subject
     */
    public function setSubject(PromotionSubjectInterface $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return PromotionInterface
     */
    public function getPromotion(): PromotionInterface
    {
        return $this->promotion;
    }

    /**
     * @param PromotionInterface $promotion
     */
    public function setPromotion(PromotionInterface $promotion): void
    {
        $this->promotion = $promotion;
    }

    public function getPromotionCode(): ?PromotionCodeInterface
    {
        return $this->promotionCode;
    }

    /**
     * @param PromotionCodeInterface $promotionCode
     */
    public function setPromotionCode(PromotionCodeInterface $promotionCode): void
    {
        $this->promotionCode = $promotionCode;
    }

    public function hasPromotionCode(): bool
    {
        return $this->promotionCode !== null;
    }

    /**
     * @return PromotionActionInterface[]|PromotionAction[]
     */
    public function getAppliedActions(): array
    {
        return $this->appliedActions;
    }

    /**
     * @param array $appliedActions
     */
    public function setAppliedActions(array $appliedActions): void
    {
        $this->appliedActions = $appliedActions;
    }


}