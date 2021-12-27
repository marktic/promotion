<?php

namespace Marktic\Promotion\Tests\Models\AbstractModels;

use Exception;
use Marktic\Promotion\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\Models\PromotionCodes\PromotionCodes;
use Marktic\Promotion\Models\PromotionRules\PromotionRules;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Utility\PromotionModels;

abstract class AbstractRepositoryTest extends AbstractTest
{
    public function test_getTable_fromConfig()
    {
        $config = require TEST_FIXTURE_PATH . '/config/mkt_promotion.php';
        $this->loadConfig($config);

        $class = $this->getRepositoryClass();
        $repositoryKey = $this->getRepositoryKey();

        /** @var CartPromotions $repository */
        $repository = new $class();
        self::assertSame($config['tables'][$repositoryKey], $repository->getTable());
    }

    abstract protected function getRepositoryClass(): string;

    /**
     * @throws Exception
     */
    protected function getRepositoryKey(): string
    {
        switch ($this->getRepositoryClass()) {
            case CartPromotions::class:
                return PromotionModels::PROMOTIONS;

            case PromotionCodes::class:
                return PromotionModels::PROMOTION_CODES;

            case PromotionActions::class:
                return PromotionModels::PROMOTION_ACTIONS;

            case PromotionRules::class:
                return PromotionModels::PROMOTION_RULES;
        }

        throw new Exception('Repository key not found');
    }
}
