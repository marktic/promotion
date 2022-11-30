<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionAction.
 */
class PromotionAction extends Record implements PromotionActionInterface
{
    use CommonRecordTrait;
    use PromotionActionTrait;

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
