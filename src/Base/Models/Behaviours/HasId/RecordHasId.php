<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasId;

trait RecordHasId
{
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = (int) $id;
    }
}
