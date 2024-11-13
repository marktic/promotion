<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasPool;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\Promotions\Models\PromotionInterface;

trait RecordHasPool
{

    protected ?string $pool = null;

    protected ?int $pool_id = null;

    public function getPool(): ?string
    {
        return $this->pool;
    }

    public function setPool(?string $pool): void
    {
        $this->pool = $pool;
    }

    public function getPoolId(): ?int
    {
        return $this->pool_id;
    }

    public function setPoolId(?int $pool_id): void
    {
        $this->pool_id = $pool_id;
    }
}
