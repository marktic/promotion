<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardConfiguration;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;

/**
 * Trait GiftCardTrait.
 * @method GiftProduct getGiftProduct()
 */
trait GiftCardTrait
{
    use RecordHasId;
    use RecordHasPool;
    use RecordHasConfiguration;
    use TimestampableTrait;

    protected function castConfigurationClass(): string
    {
        return GiftCardConfiguration::class;
    }
}
