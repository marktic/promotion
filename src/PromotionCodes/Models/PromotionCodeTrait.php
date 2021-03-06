<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasCode\RecordHasCode;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;

trait PromotionCodeTrait
{
    use RecordHasId;
    use RecordHasCode;
    use RecordHasUsage;
    use RecordHasPromotion;
    use RecordHasValidity;
    use TimestampableTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
        $this->registerValidityCast();
    }

    public function getName(): ?string
    {
        return $this->getCode();
    }
}
