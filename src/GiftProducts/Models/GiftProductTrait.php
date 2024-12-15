<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasDescription\RecordHasDescription;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasName\RecordHasName;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\GiftProducts\DataObjects\GiftProductConfiguration;

/**
 * Trait GiftCardProductTrait.
 *
 */
trait GiftProductTrait
{
    use RecordHasId;
    use RecordHasName;
    use RecordHasDescription;
    use RecordHasPool;
    use Behaviours\HasType\HasTypeRecord;
    use RecordHasConfiguration;
    use HasMediaTrait;
    use TimestampableTrait;

    protected function castConfigurationClass(): string
    {
        return GiftProductConfiguration::class;
    }
}
