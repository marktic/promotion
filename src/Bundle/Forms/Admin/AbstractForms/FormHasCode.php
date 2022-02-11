<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\AbstractForms;

trait FormHasCode
{
    protected function initCode()
    {
        $this->addInput('code', translator()->trans('code'), false);
    }

    protected function validateCode()
    {
        $codeElement = $this->getElement('code');
        if ($codeElement->isError()) {
            return;
        }

        $value = $codeElement->getValue();
        if (empty($value)) {
            return;
        }

        $this->getModel()->setPropertyValue('code', $value);
        if ($this->getModel()->exists()) {
            $codeElement->addError($this->getModelMessage('code.exists'));
        }
    }
}
