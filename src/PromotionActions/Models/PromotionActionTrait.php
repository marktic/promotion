<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasType\RecordHasType;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;

trait PromotionActionTrait
{
    use RecordHasConfiguration;
    use RecordHasId;
    use RecordHasPromotion;
    use RecordHasType;
    use TimestampableTrait;

    public function getName(): ?string
    {
        return $this->getType();
    }
}
