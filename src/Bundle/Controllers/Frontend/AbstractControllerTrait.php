<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Frontend;

use Nip\Controllers\Response\ResponsePayload;
use Nip\View\View;

/**
 * @method ResponsePayload payload()
 */
trait AbstractControllerTrait
{
    use \Nip\Controllers\Traits\AbstractControllerTrait;

    public function getModelForm($model, $action = null)
    {
        $class = $this->getModelFormClass($model, $action);
        $form = new $class();
        $form->setModel($model);

        return $form;
    }

    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        $path = __DIR__ . '/../../Resources/views/frontend';
        $view->addPath($path);
        $view->addPath($path, 'MarkticPromotion');
    }
}
