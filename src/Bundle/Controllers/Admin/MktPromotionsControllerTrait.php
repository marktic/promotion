<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Nip\Controllers\Traits\AbstractControllerTrait;

trait MktPromotionsControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    public function poolIndex()
    {
        $this->doModelsListing();
    }
}