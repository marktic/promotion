<?php


use Marktic\Promotion\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\Models\PromotionCodes\PromotionCodes;
use Marktic\Promotion\Models\PromotionRules\PromotionRules;
use Marktic\Promotion\Utility\PromotionModels;

return [
    'models' => array(
        PromotionModels::PROMOTIONS => CartPromotions::class,
        PromotionModels::PROMOTION_ACTIONS => PromotionActions::class,
        PromotionModels::PROMOTION_CODES => PromotionCodes::class,
        PromotionModels::PROMOTION_RULES => PromotionRules::class,
    ),
    'tables' => [
        PromotionModels::PROMOTIONS => 'mk_promotions',
        PromotionModels::PROMOTION_ACTIONS => 'mk_promotion_actions',
        PromotionModels::PROMOTION_CODES => 'mk_promotion_codes',
        PromotionModels::PROMOTION_RULES => 'mk_promotion_rules',
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
