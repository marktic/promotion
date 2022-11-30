<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasCode\RecordHasCode;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;

trait PromotionCodeTrait
{
    use RecordHasCode;
    use RecordHasId;
    use RecordHasPromotion;
    use RecordHasUsage;
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
