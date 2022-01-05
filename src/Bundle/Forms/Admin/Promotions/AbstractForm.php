<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasCode;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasDates;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasUsage;
use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\Utility\PromotionModels;


abstract class AbstractForm extends FormModel
{
    use FormHasCode;
    use FormHasUsage;
    use FormHasDates;

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

    protected function initExclusive()
    {
        $this->addRadioGroup('exclusive', PromotionModels::promotions()->getLabel('exclusive'), true);
        $this->exclusive->addOption('no', translator()->trans('no'));
        $this->exclusive->addOption('yes', translator()->trans('yes'));
        $this->exclusive->getRenderer()->setSeparator('');
    }

    public function getDataFromModel()
    {
        parent::getDataFromModel();
//        $this->initRaces();
//        $this->initValues();
    }

    /**
     * @inheritdoc
     */
    public function process(): bool
    {
        $this->saveToModel();
        $this->getModel()->saveRecord();
//        $this->getModel()->saveAmounts();
        return true;
    }

    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelDates();
    }

    public function processValidation()
    {
        parent::processValidation();

        $this->validateCode();
        $this->validateUsageLimit();
        $this->validateValues();
        $this->validateDates();
    }
}