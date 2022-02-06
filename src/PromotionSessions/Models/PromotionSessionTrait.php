<?php

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;

trait PromotionSessionTrait
{
    use RecordHasConfiguration;
    use RecordHasPromotion;

    public function getName(): ?string
    {
        return 'Promotion Session';
    }

}
