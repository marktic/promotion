<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\AbstractForms;

use Marktic\Promotion\Utility\PromotionModels;
use Nip\Form\Elements\AbstractElement;

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
        $this->getUsageLimitElement()->setAttrib('min', '0');
    }

    protected function initUses()
    {
        $this->addNumber('used', translator()->trans('uses'), false);
        $this->getUsedElement()->setAttrib('readonly', 'readonly');
    }

    protected function validateUsageLimit()
    {
        if (!$this->getUsageLimitElement()->isError()) {
            if (!is_numeric($this->getUsageLimitElement()->getValue())) {
                $this->getUsageLimitElement()->adderror($this->getModelMessage('usage_limit.bad'));
            }
        }
    }

    protected function getUsedElement(): ?AbstractElement
    {
        return $this->getElement('used');
    }

    protected function getUsageLimitElement(): ?AbstractElement
    {
        return $this->getElement('usage_limit');
    }
}