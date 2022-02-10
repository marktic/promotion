<?php

namespace Marktic\Promotion\PromotionSubjects\Models;

use Marktic\Promotion\Utility\PromotionModels;

trait PromotionSubjectRepositoryTrait
{
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsPromotions();
    }

    protected function initRelationsPromotions()
    {
        $this->initRelationsPromotionSessions();
    }

    protected function initRelationsPromotionSessions()
    {
        $this->morphMany(
            'PromotionSessions',
            [
                'class' => get_class(PromotionModels::promotionSessions()),
                'morphPrefix' => 'subject',
                'morphTypeField' => 'subject'
            ]
        );
    }
}