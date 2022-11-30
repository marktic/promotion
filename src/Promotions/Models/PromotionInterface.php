<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasActions\HasActionsInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasCode\HasCodeInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasId\HasIdInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasRules\HasRulesInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\HasUsageInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\HasValidityInterface;

interface PromotionInterface extends HasRulesInterface, HasActionsInterface, HasUsageInterface, HasValidityInterface, HasCodeInterface, HasIdInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getPriority(): ?int;

    public function setPriority(?int $priority): void;

    public function isExclusive(): bool;

    public function setExclusive(?bool $exclusive): void;
}
