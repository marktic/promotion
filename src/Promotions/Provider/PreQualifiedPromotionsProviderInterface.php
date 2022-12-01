<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Provider;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface PreQualifiedPromotionsProviderInterface
{
    /**
     * @param PromotionSubjectInterface $promotionSubject
     * @return PromotionInterface[]
     */
    public function getPromotionsFor(PromotionSubjectInterface $promotionSubject): array;
}
