<?php

declare(strict_types=1);

namespace Marktic\Promotion;

use ByTIC\PackageBase\BaseBootableServiceProvider;
use Marktic\Promotion\GiftProducts\Models\GiftProducts;
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
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Locator\ModelLocator;

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

    /**
     * @return void
     */
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

    protected function registerCommands(): void
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
//                ActionCommandsService::class,
                RuleConditionsServiceInterface::class,
                static::SERVICE_RULE_CONDITIONS,
                PromotionCodesRepositoryInterface::class,
            ],
            parent::provides()
        );
    }

    protected function registerActionFactory(): void
    {
        $this->getContainer()->alias(
            PromotionActionFactory::class,
            PromotionActionFactoryInterface::class
        );
    }

    protected function registerActionCommandsFactory(): void
    {
        $this->getContainer()->alias(
            PromotionActionCommandFactory::class,
            PromotionActionCommandFactoryInterface::class
        );
    }

    protected function registerActionCommandsService(): void
    {
//        $this->getContainer()->set(ActionCommandsService::class, ActionCommandsService::class, true);
    }

    protected function registerRuleConditionsService(): void
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

    protected function registerModels(): void
    {
        ModelLocator::set(GiftProducts::TABLE, PromotionModels::giftProducts());
    }
}
