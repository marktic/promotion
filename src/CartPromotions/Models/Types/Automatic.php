<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models\Types;

class Automatic extends AbstractType
{
    public const NAME = 'automatic';

    public function getColorClass(): string
    {
        return 'success';
    }
}
