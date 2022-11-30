<?php

declare(strict_types=1);

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\PromotionRules\Conditions\ItemTotalRuleCondition;
use Marktic\Promotion\PromotionRules\Models\PromotionRules;
use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Marktic\Promotion\Utility\PromotionModels;

return [
    'models' => [
        PromotionModels::PROMOTIONS => CartPromotions::class,
        PromotionModels::PROMOTION_ACTIONS => PromotionActions::class,
        PromotionModels::PROMOTION_CODES => PromotionCodes::class,
        PromotionModels::PROMOTION_RULES => PromotionRules::class,
        PromotionModels::PROMOTION_SESSIONS => PromotionSessions::class,
    ],
    'tables' => [
        PromotionModels::PROMOTIONS => 'mk_promotions',
        PromotionModels::PROMOTION_ACTIONS => 'mk_promotions_actions',
        PromotionModels::PROMOTION_CODES => 'mk_promotions_codes',
        PromotionModels::PROMOTION_RULES => 'mk_promotions_rules',
        PromotionModels::PROMOTION_SESSIONS => 'mk_promotions_sessions',
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
    'rules' => [
        'conditions' => [
            ItemTotalRuleCondition::class,
        ],
    ],
];
