<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasPromotion;

use Marktic\Promotion\Utility\PromotionModels;

trait RepositoryHasPromotion
{
    protected function initRelationsPromotion(): void
    {
        $this->belongsTo('Promotion', ['class' => \get_class(PromotionModels::promotions())]);
    }
}
