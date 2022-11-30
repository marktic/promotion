<?php

declare(strict_types=1);

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

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
