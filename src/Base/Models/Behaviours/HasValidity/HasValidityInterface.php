<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasValidity;

interface HasValidityInterface
{
    public function getValidFrom(): ?\DateTimeInterface;

    public function getValidTo(): ?\DateTimeInterface;
}
