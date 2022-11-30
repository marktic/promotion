<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Models;

use Nip\Records\AbstractModels\Record;

interface PromotionCodesRepositoryInterface
{
    /**
     * @return PromotionCode
     */
    public function findOneByCode(string $code): PromotionCodeInterface|Record|null;
}
