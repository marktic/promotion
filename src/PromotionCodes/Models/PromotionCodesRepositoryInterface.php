<?php

namespace Marktic\Promotion\PromotionCodes\Models;

interface PromotionCodesRepositoryInterface
{
    /**
     * @param string $code
     * @return PromotionCode
     */
    public function findOneByCode(string $code): ?PromotionCodeInterface;
}