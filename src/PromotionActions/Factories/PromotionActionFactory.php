<?php

namespace Marktic\Promotion\PromotionActions\Factories;

use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionActions\Models\PromotionActions;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\RecordManager;

class PromotionActionFactory
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

    public function createFixedDiscount(int $amount, string $channelCode): PromotionActionInterface
    {
        return $this->createAction(
            FixedDiscountPromotionActionCommand::TYPE,
            [$channelCode => ['amount' => $amount]]
        );
    }

    private function createAction(string $type, array $configuration): PromotionActionInterface
    {
        /** @var PromotionActionInterface $action */
        $action = $this->createNew();
        $action->setType($type);
        $action->setConfiguration($configuration);

        return $action;
    }

    public function createNew(): PromotionActionInterface
    {
        return $this->actionsRepository->getNewRecord();
    }
}