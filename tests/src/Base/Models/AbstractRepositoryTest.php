<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Base\Models;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\PromotionRules\Models\PromotionRules;
use Marktic\Promotion\PromotionSessions\Models\PromotionSessions;
use Marktic\Promotion\Tests\AbstractTest;
use Marktic\Promotion\Utility\PromotionModels;

abstract class AbstractRepositoryTest extends AbstractTest
{
    public function testGetTableFromConfig(): void
    {
        $config = require TEST_FIXTURE_PATH . '/config/mkt_promotion.php';
        $this->loadConfig($config);

        $class = $this->getRepositoryClass();
        $repositoryKey = $this->getRepositoryKey();

        /** @var CartPromotions $repository */
        $repository = new $class();
        self::assertSame($config['tables'][$repositoryKey], $repository->getTable());
    }

    protected function newRepository(): object
    {
        $class = $this->getRepositoryClass();

        return new $class();
    }

    abstract protected function getRepositoryClass(): string;

    /**
     * @throws \Exception
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

            case PromotionSessions::class:
                return PromotionModels::PROMOTION_SESSIONS;
        }

        throw new \Exception('Repository key not found');
    }
}
