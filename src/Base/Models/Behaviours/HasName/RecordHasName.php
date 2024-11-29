<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasName;

trait RecordHasName
{
    protected ?string $name = null;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
