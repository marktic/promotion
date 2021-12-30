<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasUsage;

trait RecordHasUsage
{
    protected int $usage_limit;

    protected int $used;

    /**
     * @return int
     */
    public function getUsageLimit(): int
    {
        return $this->usage_limit;
    }

    /**
     * @param int $usage_limit
     */
    public function setUsageLimit(int $usage_limit): void
    {
        $this->usage_limit = $usage_limit;
    }

    /**
     * @return int
     */
    public function getUsed(): int
    {
        return $this->used;
    }

    /**
     * @param int $used
     */
    public function setUsed(int $used): void
    {
        $this->used = $used;
    }
}