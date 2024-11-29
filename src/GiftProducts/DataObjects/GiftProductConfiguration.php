<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\DataObjects;

use ByTIC\DataObjects\Casts\Metadata\Metadata;

/**
 * Class ModelConfiguration.
 */
class GiftProductConfiguration extends Metadata
{
    public function __construct(object|array $array = [], int $flags = 0, string $iteratorClass = "ArrayIterator")
    {
        parent::__construct($array, $flags, $iteratorClass);
    }
}
