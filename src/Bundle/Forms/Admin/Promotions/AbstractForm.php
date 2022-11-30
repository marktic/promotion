<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasCode;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasDates;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasUsage;
use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\Utility\PromotionModels;

abstract class AbstractForm extends FormModel
{
    use FormHasCode;
    use FormHasDates;
    use FormHasUsage;

    public function initialize()
    {
        parent::initialize();

        $this->setAttrib('id', 'mkt-promotion-form');

        $this->addInput('name', translator()->trans('name'), true);

        $this->initCode();
        $this->initUsage();
        $this->initExclusive();
        $this->initDates();

        $this->addButton('save', translator()->trans('submit'));
    }

    protected function initExclusive(): void
    {
        $this->addRadioGroup('exclusive', PromotionModels::promotions()->getLabel('exclusive'), true);

        /** @var \Nip_Form_Element_RadioGroup $exclusiveElement */
        $exclusiveElement = $this->getElement('exclusive');
        $exclusiveElement->addOption('no', translator()->trans('no'));
        $exclusiveElement->addOption('yes', translator()->trans('yes'));
        $exclusiveElement->getRenderer()->setSeparator('');
    }

    /**
     * @return void
     */
    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelDates();
    }

    /**
     * @return void
     */
    public function processValidation()
    {
        parent::processValidation();

        $this->validateCode();
        $this->validateUsageLimit();
        $this->validateDates();
    }
}
