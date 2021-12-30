<?php

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasType\RecordHasType;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;

trait PromotionActionTrait
{
    use RecordHasType;
    use RecordHasConfiguration;
    use RecordHasUsage;
}
