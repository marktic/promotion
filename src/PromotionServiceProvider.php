<?php

declare(strict_types=1);

namespace Marktic\Promotion;

use ByTIC\PackageBase\BaseBootableServiceProvider;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactory;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionCommandFactoryInterface;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionFactory;
use Marktic\Promotion\PromotionActions\Factories\PromotionActionFactoryInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Services\ActionCommandsService;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodesRepositoryInterface;
use Marktic\Promotion\PromotionRules\Services\RuleConditionsService;
use Marktic\Promotion\PromotionRules\Services\RuleConditionsServiceInterface;
use Marktic\Promotion\Utility\PackageConfig;

/**
 * Class PromotionSeviceProvider.
 */
class PromotionServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'mkt_promotion';

    public const SERVICE_RULE_CONDITIONS = 'mkt_promotion.rules.conditions';

    public function register()
    {
        parent::register();
        $this->registerResources();
        $this->registerModels();
        $this->registerActionFactory();
        $this->registerActionCommandsFactory();
        $this->registerActionCommandsService();
        $this->registerRuleConditionsService();
    }

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return \dirname(__DIR__) . '/migrations/';
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
                ActionCommandsService::class,
                RuleConditionsServiceInterface::class,
                static::SERVICE_RULE_CONDITIONS,
                PromotionCodesRepositoryInterface::class,
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

    protected function registerRuleConditionsService()
    {
        $this->getContainer()->set(RuleConditionsServiceInterface::class, RuleConditionsService::class, true);

        $this->getContainer()->set(
            static::SERVICE_RULE_CONDITIONS,
            function () {
                $service = $this->getContainer()->get(RuleConditionsServiceInterface::class);
                $service->addFromConfig(
                    PackageConfig::rulesCondition()
                );

                return $service;
            },
            true
        );
    }

    protected function registerModels()
    {
    }
}
