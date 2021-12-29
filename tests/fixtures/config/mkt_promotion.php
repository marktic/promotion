<?php


use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\PromotionRules\Models\PromotionRules;
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
