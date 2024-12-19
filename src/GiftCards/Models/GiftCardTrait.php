<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordTrait as HasStatusRecordTrait;
use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotion;
use Marktic\Promotion\Bundle\Models\PromotionCodes\PromotionCode;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardConfiguration;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Nip\Records\Traits\HasUuid\HasUuidRecordTrait;

/**
 * Trait GiftCardTrait.
 * @method GiftProduct getGiftProduct()
 * @method GiftCardConfiguration getConfiguration()
 * @method CartPromotion getPromotion()
 * @method PromotionCode getPromotionCode()
 */
trait GiftCardTrait
{
    use RecordHasId;
    use RecordHasPool;
    use HasUuidRecordTrait;
    use RecordHasConfiguration;
    use HasStatusRecordTrait;
    use TimestampableTrait;

    public function getName()
    {
        return $this->getManager()->getLabel('title.singular') . ' ' . $this->getUuid();
    }

    public function getUuid()
    {
        return $this->getPropertyRaw('uuid');
    }

    public function hasPromotionCode(): bool
    {
        if (empty($this->code_id)) {
            return false;
        }
        $promotionCode = $this->getPromotionCode();
        if (!is_object($promotionCode)) {
            return false;
        }
        return true;
    }

    public function hasPromotion(): bool
    {
        if (empty($this->promotion_id)) {
            return false;
        }
        $promotion = $this->getPromotion();
        if (!is_object($promotion)) {
            return false;
        }
        return true;
    }

    public function setPromotionId($id): self
    {
        $this->setPropertyValue('promotion_id', $id);
        return $this;
    }

    public function setPromotionCodeId(?int $id)
    {
        $this->setPropertyValue('code_id', $id);
        return $this;
    }

    protected function castConfigurationClass(): string
    {
        return GiftCardConfiguration::class;
    }

}
