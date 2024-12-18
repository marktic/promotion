<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordTrait as HasStatusRecordTrait;
use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardConfiguration;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Nip\Records\Traits\HasUuid\HasUuidRecordTrait;

/**
 * Trait GiftCardTrait.
 * @method GiftProduct getGiftProduct()
 * @method GiftCardConfiguration getConfiguration()
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
        return $this->getManager()->getLabel('title.singular'). ' ' . $this->getUuid();
    }

    public function getUuid()
    {
        return $this->getPropertyRaw('uuid');
    }

    protected function castConfigurationClass(): string
    {
        return GiftCardConfiguration::class;
    }

}
