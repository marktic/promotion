<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasUsage;

interface HasUsageInterface
{
    public function getUsageLimit(): ?int;

    public function setUsageLimit(?int $usageLimit): void;

    public function getUsed(): ?int;

    public function setUsed(?int $used): void;

    public function incrementUsed(): void;

    public function decrementUsed(): void;
}
