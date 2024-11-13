<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasConfiguration;

use ByTIC\DataObjects\Casts\Metadata\Metadata;

interface HasConfigurationInterface
{
    public function getConfiguration(): Metadata;
}
