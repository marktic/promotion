<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models\Types;

class ValueCard extends AbstractType
{
    public const NAME = 'value_card';

    public function getColorClass(): string
    {
        return 'primary';
    }
}
