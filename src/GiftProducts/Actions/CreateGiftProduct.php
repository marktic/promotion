<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Billing\Base\Actions\Behaviours\HasResultRecordTrait;
use Marktic\Promotion\Base\Actions\Behaviours\ActionHasPool;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\GiftProducts\Models\Types\CouponCard;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\RecordManager;
use Sportic\Waiver\Base\Actions\Behaviours\HasRepository;

/**
 * @property GiftProduct $resultRecord
 */
class CreateGiftProduct extends Action
{
    use HasSubject;
    use ActionHasPool;
    use HasResultRecordTrait;
    use HasRepository;

    protected ?string $type = null;

    public function asCouponCard(): static
    {
        return $this->withType(CouponCard::NAME);
    }

    public function withType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function handle()
    {
        return $this->getResultRecord();
    }

    protected function populateResultRecord()
    {
        $this->resultRecord->populateFromPoolRecord($this->poolRecord);
        $this->resultRecord->type = $this->type;
    }

    protected function generateRepository(): RecordManager
    {
        return PromotionModels::giftProducts();
    }
}

