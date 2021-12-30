<?php

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasType\RecordHasType;

trait PromotionRuleTrait
{
    use RecordHasType;
    use RecordHasConfiguration;
}
