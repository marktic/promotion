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
        PromotionModels::PROMOTIONS => CartPromotions::TABLE,
        PromotionModels::PROMOTION_ACTIONS => PromotionActions::TABLE,
        PromotionModels::PROMOTION_CODES => PromotionCodes::TABLE,
        PromotionModels::PROMOTION_RULES => PromotionRules::TABLE,
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
