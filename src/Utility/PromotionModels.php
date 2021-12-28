<?php

namespace Marktic\Promotion\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use Marktic\Promotion\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\Models\PromotionCodes\PromotionCodes;
use Marktic\Promotion\Models\PromotionRules\PromotionRules;
use Marktic\Promotion\PromotionServiceProvider;
use Nip\Records\RecordManager;

/**
 * Class PromotionModels
 * @package Marktic\Promotion\Utility
 */
class PromotionModels extends ModelFinder
{
    public const PROMOTIONS = 'promotions';
    public const PROMOTION_ACTIONS = 'promotion_actions';
    public const PROMOTION_CODES = 'promotion_codes';
    public const PROMOTION_RULES = 'promotion_rules';
    protected static $models = [];

    /**
     * @return RecordManager|CartPromotions
     */
    public static function promotions()
    {
        return static::getModels(self::PROMOTIONS, CartPromotions::class);
    }

    /**
     * @return RecordManager|PromotionActions
     */
    public static function promotionActions()
    {
        return static::getModels(self::PROMOTION_ACTIONS, PromotionActions::class);
    }

    /**
     * @return RecordManager|PromotionCodes
     */
    public static function promotionCodes()
    {
        return static::getModels(self::PROMOTION_CODES, PromotionCodes::class);
    }

    /**
     * @return RecordManager|PromotionRules
     */
    public static function promotionRules()
    {
        return static::getModels(self::PROMOTION_RULES, PromotionRules::class);
    }

    protected static function packageName(): string
    {
        return PromotionServiceProvider::NAME;
    }
}
