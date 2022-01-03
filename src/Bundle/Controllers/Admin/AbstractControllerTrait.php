<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use Nip\View\View;

trait AbstractControllerTrait
{
    use \Nip\Controllers\Traits\AbstractControllerTrait;

    public function registerViewPaths(View $view)
    {
        parent::registerViewPaths($view);

        $path = __DIR__ . '/../../Resources/views/admin';
        $view->addPath($path);
        $view->addPath($path, 'MarkticPromotion');
    }
}