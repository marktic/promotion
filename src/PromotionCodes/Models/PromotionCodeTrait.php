<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;

trait PromotionCodeTrait
{
    use RecordHasUsage;
    use RecordHasPromotion;
    use RecordHasValidity;

    public function __construct(array $data = null)
    {
        $return = parent::__construct($data);
        $this->registerValidityCast();
        return $return;
    }

}
