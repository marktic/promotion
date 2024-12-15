<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\HasForms;
use Marktic\Promotion\Bundle\Library\View\ViewUtility;
use Nip\Controllers\Response\ResponsePayload;
use Nip\View\View;

/**
 * @method ResponsePayload payload()
 */
trait AbstractControllerTrait
{
    use \Nip\Controllers\Traits\AbstractControllerTrait;
    use HasForms;

    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        ViewUtility::registerViewPaths($view, 'admin');
    }
}
