<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasCode;

interface HasCodeInterface
{
    public function getCode(): ?string;

    public function setCode(string $type): void;
}
