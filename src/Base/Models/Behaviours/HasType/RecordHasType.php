<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasType;

trait RecordHasType
{
    protected ?string $type = null;

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}