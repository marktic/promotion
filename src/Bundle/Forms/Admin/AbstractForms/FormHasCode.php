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
        if (!$this->code->isError()) {
            $value = $this->code->getValue();
            if ($this->code->getValue()) {
                $this->getModel()->code = $value;
                if ($this->getModel()->exists()) {
                    $this->code->addError($this->getModelMessage('code.exists'));
                }
            }
        }
    }

}