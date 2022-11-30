<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\AbstractForms;

trait FormHasCode
{
    protected function initCode(): void
    {
        $this->addInput('code', translator()->trans('code'), false);
    }

    /**
     * @return void
     */
    protected function validateCode()
    {
        $codeElement = $this->getElement('code');
        if ($codeElement->isError() || false === $codeElement->hasValue()) {
            return;
        }

        $value = $codeElement->getValue();

        $this->getModel()->setPropertyValue('code', $value);
        if ($this->getModel()->exists()) {
            $codeElement->addError($this->getModelMessage('code.exists'));
        }
    }
}
