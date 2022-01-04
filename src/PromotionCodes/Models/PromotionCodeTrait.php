<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;

trait PromotionCodeTrait
{
    use RecordHasUsage;
    use RecordHasPromotion;
}
