<?php

namespace Marktic\Promotion\Bundle\Models\CartPromotions\Filters;

use Nip\Records\Filters\FilterManager as CommonFilterManager;

/**
 * Class FilterManager
 * @package Marktic\Promotion\Bundle\Models\CartPromotions\Filters
 */
class FilterManager extends CommonFilterManager
{
    public function init()
    {
        parent::init();

        foreach (['pool', 'pool_id'] as $field) {
            $this->addFilter(
                $this->newFilter('Column\BasicFilter')->setField($field)
            );
        }
    }
}
