<?php

namespace Marktic\Promotion\Models\PromotionActions;

use Marktic\Promotion\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionAction
 * @package Marktic\Promotion\Models\PromotionActions
 */
class PromotionAction extends Record
{
    use PromotionActionTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
