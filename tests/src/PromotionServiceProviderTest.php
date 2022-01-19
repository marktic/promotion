<?php

namespace Marktic\Promotion\Tests;

use Marktic\Promotion\PromotionRules\Services\RuleConditionsService;
use Marktic\Promotion\PromotionServiceProvider;

/**
 * Class PromotionSeviceProvider
 * @package ByTIC\NotifierBuilder
 */
class PromotionServiceProviderTest extends AbstractTest
{
    public function test_registerRuleConditionsService()
    {
        $this->loadConfigFromFixture('mkt_promotion');
        $provider = $this->loadServiceProvider();

        /** @var RuleConditionsService $service */
        $service = $provider->getContainer()->get(PromotionServiceProvider::SERVICE_RULE_CONDITIONS);
        self::assertInstanceOf(RuleConditionsService::class, $service);

        self::assertGreaterThanOrEqual(1, count($service->all()));
    }
}
