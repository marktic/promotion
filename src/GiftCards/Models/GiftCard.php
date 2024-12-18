<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use Marktic\Promotion\Base\Models\Traits\CommonRecordTrait;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Nip\Records\Record;

/**
 * Class GiftCard.
 * @method GiftProduct getGiftProduct()
 */
class GiftCard extends Record
{
    use GiftCardTrait;
    use CommonRecordTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
        $this->registerCastConfiguration();
    }

    /**
     * @return void
     */
    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
