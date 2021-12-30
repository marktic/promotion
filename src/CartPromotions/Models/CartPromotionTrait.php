<?php

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Nip\Records\Collections\Collection;

/**
 * Trait CartPromotionTrait
 *
 * @method PromotionCode[]|Collection getPromotionCodes
 * @method PromotionAction[]|Collection getPromotionActions
 */
trait CartPromotionTrait
{
    protected string $name;

    protected string $description;

    protected int $priority;

    protected bool $exclusive;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): void
    {
        $this->priority = $priority;
    }

    public function isExclusive(): bool
    {
        return $this->exclusive === true;
    }

    public function setExclusive(?bool $exclusive): void
    {
        $this->exclusive = $exclusive;
    }
}
