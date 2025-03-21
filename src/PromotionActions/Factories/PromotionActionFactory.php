<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Factories;

use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Commands\PercentageDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\RecordManager;

class PromotionActionFactory implements PromotionActionFactoryInterface
{
    /** @var RecordManager|PromotionActions */
    private $actionsRepository;

    /**
     * @param PromotionActions|RecordManager $actionsRepository
     */
    public function __construct($actionsRepository = null)
    {
        $this->actionsRepository = $actionsRepository ?? PromotionModels::promotionActions();
    }

    public function createFixedDiscount(int $amount): PromotionActionInterface
    {
        return $this->create(
            FixedDiscountActionCommand::NAME,
            ['amount' => $amount]
        );
    }

    public function createAmountDiscount(int $amount): PromotionActionInterface
    {
        return $this->create(
            FixedDiscountActionCommand::NAME,
            ['amount' => $amount]
        );
    }

    public function createPercentageDiscount(float $percentage): PromotionActionInterface
    {
        return $this->create(
            PercentageDiscountActionCommand::NAME,
            ['amount' => $percentage]
        );
    }

    public function create(string $type, array $configuration): PromotionActionInterface
    {
        $action = $this->createNew();
        $action->setType($type);
        $action->setConfiguration($configuration);

        return $action;
    }

    private function createNew(): PromotionActionInterface
    {
        return $this->actionsRepository->getNewRecord();
    }
}
