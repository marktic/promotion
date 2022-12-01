<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator;

class PromotionApplicator extends AbstractPromotionApplicator
{
    use Behaviours\ApplyPromotion;
    use Behaviours\RevertPromotion;

}
