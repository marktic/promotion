<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Bytic\Actions\Behaviours\Entities\HasResultRecordTrait;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 * @method GiftProduct getSubject()
 * @method GiftCard getResultRecord()
 */
class GenerateForProduct extends Action
{
    use HasSubject;
    use HasResultRecordTrait;
    use HasRepository;

    public function handle()
    {
        return $this->getResultRecord();
    }

    protected function populateResultRecord()
    {
        $this->resultRecord->populateFromPoolRecord($this->getSubject()->getPromotionPool());
        $this->resultRecord->product_id = $this->getSubject()->id;
    }

    protected function generateRepository(): RecordManager
    {
        return PromotionModels::giftCards();
    }
}