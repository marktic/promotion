<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasType;

interface HasTypeInterface
{
    public function getType(): ?string;

    public function setType(string $type): void;
}
