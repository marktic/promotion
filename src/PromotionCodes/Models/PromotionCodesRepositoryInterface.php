<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Models;

interface PromotionCodesRepositoryInterface
{
    /**
     * @return PromotionCode
     */
    public function findOneByCode(string $code): ?PromotionCodeInterface;
}
