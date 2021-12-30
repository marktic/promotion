<?php

namespace Marktic\Promotion\Utility;

use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Nip\Container\Utility\Container;

class PromotionServices
{
    public static function actionCommands(): ActionCommandsService
    {
        return Container::container()->get(ActionCommandsService::class);
    }
}