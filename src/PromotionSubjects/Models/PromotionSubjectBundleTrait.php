<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Models;

use Nip\Records\Collections\Collection;

trait PromotionSubjectBundleTrait
{
    abstract public function getPromotionSubjects(): Collection;

    public function getPromotionSubjectCount(): int
    {
        return \count($this->getPromotionSubjects());
    }
}
