<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasId;

interface HasIdInterface
{
    public function getId(): ?int;
}
