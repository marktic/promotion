<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Bytic\Actions\Behaviours\Entities\HasResultRecordTrait;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Promotion\Base\Actions\Behaviours\ActionHasPool;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\GiftProducts\Models\Types\CouponCard;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\RecordManager;

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

    public function create()
    {
        $record = $this->getResultRecord();
        $record->save();
        return $record;
    }

    protected function populateResultRecord()
    {
        $this->resultRecord->populateFromPoolRecord($this->poolRecord);
        $this->resultRecord->setType($this->type);
    }

    protected function generateRepository(): RecordManager
    {
        return PromotionModels::giftProducts();
    }
}
