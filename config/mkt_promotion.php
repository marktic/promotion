<?php

declare(strict_types=1);

use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\Bundle\Models\PromotionCodes\PromotionCodes;
use Marktic\Promotion\Bundle\Models\PromotionRules\PromotionRules;
use Marktic\Promotion\Bundle\Models\PromotionSessions\PromotionSessions;
use Marktic\Promotion\PromotionRules\Conditions\ItemQuantityRuleCondition;
use Marktic\Promotion\PromotionRules\Conditions\ItemTotalRuleCondition;
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
        PromotionModels::PROMOTIONS => CartPromotions::TABLE,
        PromotionModels::PROMOTION_ACTIONS => PromotionActions::TABLE,
        PromotionModels::PROMOTION_CODES => PromotionCodes::TABLE,
        PromotionModels::PROMOTION_RULES => PromotionRules::TABLE,
        PromotionModels::PROMOTION_SESSIONS => PromotionSessions::TABLE,
    ],
    'currencies' => [
        'default' => 'EUR',
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
    'rules' => [
        'conditions' => [
            ItemQuantityRuleCondition::class,
            ItemTotalRuleCondition::class,
        ],
    ],
];
