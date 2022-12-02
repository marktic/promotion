<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSubjects\Models;

use Marktic\Promotion\PromotionSessions\Models\PromotionSession;
use Nip\Records\Collections\Collection;

/**
 * @method Collection|PromotionSession getPromotionSessions()
 */
interface PromotionSubjectBundleInterface extends CountablePromotionSubjectInterface
{
    /**
     * @return Collection|PromotionSubjectInterface[]
     *
     * @psalm-return Collection<array-key, PromotionSubjectInterface>
     */
    public function getPromotionSubjects(): Collection;
}
