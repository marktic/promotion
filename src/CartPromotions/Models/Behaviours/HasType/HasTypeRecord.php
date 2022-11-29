<?php

namespace Marktic\Promotion\CartPromotions\Models\Behaviours\HasType;

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
