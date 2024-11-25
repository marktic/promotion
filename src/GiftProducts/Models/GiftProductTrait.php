<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardConfiguration;

/**
 * Trait GiftCardProductTrait.
 *
 */
trait GiftProductTrait
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
