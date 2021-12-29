<?php

namespace Marktic\Promotion\Base\Models;

interface PromotionInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getPriority(): int;

    public function setPriority(?int $priority): void;

    public function isExclusive(): bool;

    public function setExclusive(?bool $exclusive): void;
}
