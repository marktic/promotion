<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class PromotionSession.
 */
class PromotionSession extends Record
{
    use CommonRecordTrait;
    use PromotionSessionTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
        $this->registerCastConfiguration();
    }

    public function getRegistry(): void
    {
        // TODO: Implement getRegistry() method.
    }
}
