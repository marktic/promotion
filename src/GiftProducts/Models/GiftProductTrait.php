<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasName\RecordHasName;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\GiftCards\DataObjects\GiftProductConfiguration;

/**
 * Trait GiftCardProductTrait.
 *
 */
trait GiftProductTrait
{
    use RecordHasId;
    use RecordHasName;
    use RecordHasPool;
    use Behaviours\HasType\HasTypeRecord;
    use RecordHasConfiguration;
    use TimestampableTrait;

    public function getName()
    {
        return $this->getPropertyValue('name');
    }

    public function setName($name): void
    {
        $this->setPropertyValue('name', $name);
    }

    protected function castConfigurationClass(): string
    {
        return GiftProductConfiguration::class;
    }
}
