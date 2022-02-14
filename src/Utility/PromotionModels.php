<?php

namespace Marktic\Promotion\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\Bundle\Models\PromotionCodes\PromotionCodes;
use Marktic\Promotion\Bundle\Models\PromotionRules\PromotionRules;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodesRepositoryInterface;
use Marktic\Promotion\PromotionServiceProvider;
use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Nip\Records\RecordManager;
use Psr\Container\ContainerInterface;

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
    public const PROMOTION_SESSIONS = 'promotion_sessions';

    /**
     * @return CartPromotions|RecordManager
     */
    public static function promotions()
    {
        return static::getModels(self::PROMOTIONS, CartPromotions::class);
    }

    /**
     * @return PromotionActions
     */
    public static function promotionActions()
    {
        return static::getModels(self::PROMOTION_ACTIONS, PromotionActions::class);
    }

    /**
     * @return PromotionCodes
     */
    public static function promotionCodes(): PromotionCodesRepositoryInterface
    {
        return static::getModels(self::PROMOTION_CODES, PromotionCodes::class);
    }

    /**
     * @return PromotionRules|RecordManager
     */
    public static function promotionRules()
    {
        return static::getModels(self::PROMOTION_RULES, PromotionRules::class);
    }

    /**
     * @return PromotionSessions|RecordManager
     */
    public static function promotionSessions()
    {
        return static::getModels(self::PROMOTION_SESSIONS, PromotionSessions::class);
    }

    public static function registerInContainer(ContainerInterface $container)
    {
        $container->set(
            PromotionCodesRepositoryInterface::class,
            function () {
                return PromotionModels::promotionCodes();
            },
            true
        );
    }

    protected static function packageName(): string
    {
        return PromotionServiceProvider::NAME;
    }
}
