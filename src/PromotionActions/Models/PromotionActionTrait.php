<?php

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasType\RecordHasType;

trait PromotionActionTrait
{
    use RecordHasId;
    use RecordHasType;
    use RecordHasConfiguration;
    use RecordHasPromotion;

    public function getName(): ?string
    {
        return $this->getType();
    }

}
