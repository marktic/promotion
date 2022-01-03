<?php

namespace Marktic\Promotion;

use ByTIC\PackageBase\BaseBootableServiceProvider;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactory;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactoryInterface;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionFactory;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionFactoryInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\Utility\PackageConfig;

/**
 * Class PromotionSeviceProvider
 * @package ByTIC\NotifierBuilder
 */
class PromotionServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'mkt_promotion';

    public function register()
    {
        parent::register();
        $this->registerResources();
        $this->registerActionFactory();
        $this->registerActionCommandsFactory();
        $this->registerActionCommandsService();
    }

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return dirname(__DIR__) . '/migrations/';
        }

        return null;
    }

    protected function registerResources()
    {
        if (false === $this->getContainer()->has('translator')) {
            return;
        }
        $translator = $this->getContainer()->get('translator');
        $folder = __DIR__ . '/Bundle/Resources/lang/';
        $languages = $this->getContainer()->get('translation.languages');


        foreach ($languages as $language) {
            $path = $folder . $language;
            if (is_dir($path)) {
                $translator->addResource('php', $path, $language);
            }
        }
    }

    protected function registerCommands()
    {
//        $this->commands(
//        );
    }

    /**
     * @return array|PromotionActionInterface[]
     */
    public function provides(): array
    {
        return array_merge(
            [
                PromotionActionFactoryInterface::class,
                PromotionActionCommandFactoryInterface::class,
                ActionCommandsService::class
            ],
            parent::provides()
        );
    }

    protected function registerActionFactory()
    {
        $this->getContainer()->alias(
            PromotionActionFactory::class,
            PromotionActionFactoryInterface::class
        );
    }

    protected function registerActionCommandsFactory()
    {
        $this->getContainer()->alias(
            PromotionActionCommandFactory::class,
            PromotionActionCommandFactoryInterface::class
        );
    }

    protected function registerActionCommandsService()
    {
        $this->getContainer()->set(ActionCommandsService::class, ActionCommandsService::class, true);
    }
}
