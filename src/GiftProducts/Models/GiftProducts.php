<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPool\RepositoryHasPoolInterface;
use Marktic\Promotion\Base\Models\Traits\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class GiftCardProducts.
 */
class GiftProducts extends RecordManager implements RepositoryHasPoolInterface
{
    use GiftProductsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'mkt_gift_products';
    public const CONTROLLER = 'mkt_gift_products';
}
