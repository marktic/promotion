<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPool\RepositoryHasPoolInterface;
use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Events.
 */
class GiftCards extends RecordManager implements RepositoryHasPoolInterface
{
    use GiftCardsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_gift_cards';
    public const CONTROLLER = 'mkt_gift_cards';
}
