<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\CardStatuses;

use ByTIC\Models\SmartProperties\Properties\Statuses\Generic;

abstract class AbstractStatus extends Generic
{
    public const NAME = null;

    public function canGeneratePromotion(): bool
    {
        return false;
    }

    protected function generateName(): string
    {
        return static::NAME;
    }
}