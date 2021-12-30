<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

trait AbstractControllerTrait
{
    use \Nip\Controllers\Traits\AbstractControllerTrait;

    protected function registerViewPaths()
    {
        $path = __DIR__ . '/../../Resources/views/admin';
        $this->getView()->addPath($path);
        $this->getView()->addPath($path, 'MarkticPromotion');
    }
}