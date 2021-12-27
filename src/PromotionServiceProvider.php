<?php

namespace Marktic\Promotion;

use ByTIC\PackageBase\BaseBootableServiceProvider;
use Marktic\Promotion\Utility\PackageConfig;

/**
 * Class PromotionSeviceProvider
 * @package ByTIC\NotifierBuilder
 */
class PromotionServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'mkt_promotion';

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return dirname(__DIR__) . '/migrations/';
        }

        return null;
    }

    protected function registerCommands()
    {
//        $this->commands(
//        );
    }
}
