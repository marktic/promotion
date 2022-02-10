<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasValidity;

use DateTimeInterface;

interface HasValidityInterface
{

    public function getValidFrom(): ?DateTimeInterface;

    public function getValidTo(): ?DateTimeInterface;
}