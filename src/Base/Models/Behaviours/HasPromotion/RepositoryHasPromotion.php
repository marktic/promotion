<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasPromotion;

use Marktic\Promotion\Utility\PromotionModels;

trait RepositoryHasPromotion
{

    protected function initRelationsPromotion()
    {
        $this->belongsTo('Promotion', ['class' => get_class(PromotionModels::promotions())]);
    }

}
