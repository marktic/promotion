<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Utility\PromotionServices;

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

        $this->payload()->with([
            'pool' => $this->getRequest()->get('pool'),
            'pool_id' => $this->getRequest()->get('pool_id'),
            'actionCommands' => PromotionServices::actionCommands()->all()
        ]);
    }
}