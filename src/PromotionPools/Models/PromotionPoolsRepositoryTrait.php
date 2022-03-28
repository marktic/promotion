<?php

namespace Marktic\Promotion\PromotionPools\Models;

use Marktic\Promotion\Utility\PromotionModels;

trait PromotionPoolsRepositoryTrait
{

    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsPromotions();
    }

    protected function initRelationsPromotions()
    {
        $this->initRelationsCartPromotions();
    }

    protected function initRelationsCartPromotions()
    {
        $this->morphMany(
            'CartPromotions',
            [
                'class' => get_class(PromotionModels::promotions()),
                'morphPrefix' => 'pool',
                'morphTypeField' => 'pool'
            ]
        );
    }
}