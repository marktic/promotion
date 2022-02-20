<?php

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionSession
 * @package Marktic\Promotion\Models\PromotionSessions
 */
class PromotionSession extends Record
{
    use PromotionSessionTrait;
    use CommonRecordTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
        $this->registerCastConfiguration();
    }

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }

}
