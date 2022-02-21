<?php

namespace Marktic\Promotion\CartPromotions\Validations;

use Marktic\Promotion\Base\Validations\CompositeValidatePromotion;
use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\PromotionRules\Validations\ValidatePromotionRules;
use Marktic\Promotion\Promotions\Validations\ValidatePromotionDurationLimit;
use Marktic\Promotion\Promotions\Validations\ValidatePromotionExclusivity;
use Marktic\Promotion\Promotions\Validations\ValidatePromotionNotApplied;

class ValidationsFactory
{
    public static function create(): ValidatesPromotion
    {
        return new CompositeValidatePromotion([
            new ValidatePromotionDurationLimit(),
            new ValidatePromotionExclusivity(),
            new ValidatePromotionNotApplied(),
            new ValidatePromotionRules(),
        ]);
    }
}