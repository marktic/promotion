<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\AbstractForms;

trait FormHasDates
{
    protected function initDates()
    {
        $this->addDateinput('valid_from', translator()->trans('valid_from'), false)
            ->addDateinput('valid_to', translator()->trans('valid_to'), false);
    }

    protected function validateDates()
    {
        if ($this->valid_from->getValue() && $this->valid_to->getValue()) {
            if (!$this->valid_from->isError() && !$this->valid_to->isError()) {
                if ($this->valid_from->getUnix() > $this->valid_to->getUnix()) {
                    $this->valid_to->addError($this->getModelMessage('valid_to.to-small'));
                }
            }
        }
    }

}