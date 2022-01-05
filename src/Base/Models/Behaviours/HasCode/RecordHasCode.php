<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasCode;

trait RecordHasCode
{
    protected ?string $code = null;

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}