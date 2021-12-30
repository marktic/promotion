<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;

trait MktPromotionsControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    protected function forwardToPoolIndex()
    {
        $this->registerViewPaths();
        $this->forward('poolIndex');
    }

    public function poolIndex()
    {
        $this->doModelsListing();
    }
}