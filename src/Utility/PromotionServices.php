<?php

declare(strict_types=1);

namespace Marktic\Promotion\Utility;

use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsServiceInterface;
use Marktic\Promotion\PromotionRules\Services\RuleConditionsService;
use Marktic\Promotion\PromotionServiceProvider;
use Nip\Container\Utility\Container;

class PromotionServices
{
    public static function actionCommands(): ActionCommandsService
    {
        return Container::container()->get(ActionCommandsServiceInterface::class);
    }

    public static function ruleConditions(): RuleConditionsService
    {
        return Container::container()->get(PromotionServiceProvider::SERVICE_RULE_CONDITIONS);
    }
}
