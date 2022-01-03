<?php

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\PromotionRules\Models\PromotionRule;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Collections\Collection;

/**
 * Trait CartPromotionTrait
 *
 * @method Record getPromotionPool
 * @method PromotionCode[]|Collection getPromotionCodes
 * @method PromotionAction[]|Collection getPromotionActions
 * @method PromotionRule[]|Collection getPromotionRules
 */
trait CartPromotionTrait
{
    use RecordHasUsage;

    protected ?string $pool = null;

    protected ?int $pool_id = null;

    protected ?string $name = null;

    protected string $description;

    protected ?int $priority = null;

    protected bool $exclusive = false;

    /**
     * @return string
     */
    public function getName(): ?string
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

    public function getPriority(): ?int
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
        $this->exclusive = ($exclusive === true);
    }

    /**
     * @return string|null
     */
    public function getPool(): ?string
    {
        return $this->pool;
    }

    /**
     * @param string|null $pool
     */
    public function setPool(?string $pool): void
    {
        $this->pool = $pool;
    }

    /**
     * @return int|null
     */
    public function getPoolId(): ?int
    {
        return $this->pool_id;
    }

    /**
     * @param int|null $pool_id
     */
    public function setPoolId(?int $pool_id): void
    {
        $this->pool_id = $pool_id;
    }
}
