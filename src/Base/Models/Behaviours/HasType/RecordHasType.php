<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasType;

trait RecordHasType
{
    protected ?string $type = null;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isOfType(string $type): bool
    {
        return $this->getType() === $type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
