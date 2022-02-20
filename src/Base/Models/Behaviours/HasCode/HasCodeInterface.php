<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasCode;

interface HasCodeInterface
{
    public function getCode(): ?string;

    public function setCode(string $type): void;
}