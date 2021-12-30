<?php

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionAction
 * @package Marktic\Promotion\Models\PromotionActions
 */
class PromotionAction extends Record implements PromotionActionInterface
{
    use PromotionActionTrait;
    use CommonRecordTrait;

    public function __construct(array $data = null)
    {
        $return = parent::__construct($data);
        $this->registerCastConfiguration();
        return $return;
    }

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
