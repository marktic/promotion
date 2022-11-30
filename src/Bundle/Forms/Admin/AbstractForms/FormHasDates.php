<?php

declare(strict_types=1);

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
        $fromElement = $this->getElement('valid_from');
        $toElement = $this->getElement('valid_to');

        if ($fromElement->isError() || $toElement->isError()) {
            return;
        }

        if ($fromElement->hasValue() && $toElement->hasValue()) {
            if ($fromElement->getUnix() > $toElement->getUnix()) {
                $toElement->addError($this->getModelMessage('valid_to.to-small'));

                return;
            }
        }
    }

    protected function saveToModelDates()
    {
        $toElement = $this->getElement('valid_to');

        if ($toElement->hasValue()) {
            $this->getModel()->set('valid_to', $toElement->getValue() . ' 23:59:59');
        }
    }
}
