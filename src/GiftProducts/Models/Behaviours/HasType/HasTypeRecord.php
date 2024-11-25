<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models\Behaviours\HasType;

use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordTrait as RecordHasTypeObject;
use Marktic\Promotion\Base\Models\Behaviours\HasType\RecordHasType;

trait HasTypeRecord
{
    use RecordHasType;
    use RecordHasTypeObject {
        RecordHasType::getType insteadof RecordHasTypeObject;
        RecordHasTypeObject::getType as getTypeObject;
        RecordHasType::setType insteadof RecordHasTypeObject;
        RecordHasTypeObject::setType as setTypeObject;
    }
}
