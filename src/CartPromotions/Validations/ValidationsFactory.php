<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Validations;

use Marktic\Promotion\Base\Validations\CompositeValidatePromotion;
use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\PromotionRules\Validations\ValidatePromotionRules;
use Marktic\Promotion\Promotions\Validation\ValidatePromotionDurationLimit;
use Marktic\Promotion\Promotions\Validation\ValidatePromotionExclusivity;
use Marktic\Promotion\Promotions\Validation\ValidatePromotionNotApplied;

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
