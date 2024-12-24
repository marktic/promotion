<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasDescription;

trait RecordHasDescription
{
    protected ?string $description = null;

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
