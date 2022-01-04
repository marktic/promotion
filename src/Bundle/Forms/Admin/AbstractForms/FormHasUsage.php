<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\AbstractForms;

use Marktic\Promotion\Utility\PromotionModels;

trait FormHasUsage
{
    protected function initUsage()
    {
        $this->initUsageLimit();
        $this->initUses();
    }

    protected function initUsageLimit()
    {
        $this->addNumber('usage_limit', PromotionModels::promotions()->getLabel('usage_limit'), true);
        $this->usage_limit->setAttrib('min', '0');
    }

    protected function initUses()
    {
        $this->addNumber('used', translator()->trans('uses'), false);
        $this->used->setAttrib('readonly', 'readonly');
    }

    protected function validateUsageLimit()
    {
        if (!$this->usage_limit->isError()) {
            if (!is_numeric($this->usage_limit->getValue())) {
                $this->usage_limit->adderror($this->getModelMessage('usage_limit.bad'));
            }
        }
    }

}