<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models\Filters;

use Nip\Records\Filters\FilterManager as CommonFilterManager;

/**
 * Class FilterManager.
 */
class FilterManager extends CommonFilterManager
{
    /**
     * @return void
     */
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
