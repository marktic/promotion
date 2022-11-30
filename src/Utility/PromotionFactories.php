<?php

declare(strict_types=1);

namespace Marktic\Promotion\Utility;

use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactoryInterface;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionFactoryInterface;
use Nip\Container\Utility\Container;

class PromotionFactories
{
    public static function actions(): PromotionActionFactoryInterface
    {
        return Container::container()->get(PromotionActionFactoryInterface::class);
    }

    public static function actionCommands(): PromotionActionCommandFactoryInterface
    {
        return Container::container()->get(PromotionActionCommandFactoryInterface::class);
    }
}
