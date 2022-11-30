<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasType\RecordHasType;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;

trait PromotionRuleTrait
{
    use RecordHasConfiguration;
    use RecordHasPromotion;
    use RecordHasType;
    use TimestampableTrait;

    public function getName(): ?string
    {
        return $this->getType();
    }
}
