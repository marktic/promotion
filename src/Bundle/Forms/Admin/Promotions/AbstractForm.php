<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\Utility\PromotionModels;

abstract class AbstractForm extends FormModel
{
    public function initialize()
    {
        parent::initialize();

        $this->setAttrib('id', 'mkt-promotion-form');

        $this->addInput('name', translator()->trans('name'), true);
        $this->initCode();
        $this->addInput('usage_limit', PromotionModels::promotions()->getLabel('usage_limit'), true);

        $this->initExclusive();

        $this->initDates();

        $this->addButton('save', translator()->trans('submit'));
    }

    protected function initCode()
    {
        $this->addInput('code', translator()->trans('code'), false);
    }

    protected function initExclusive()
    {
        $this->addRadioGroup('exclusive', PromotionModels::promotions()->getLabel('exclusive'), true);
        $this->exclusive->addOption('no', translator()->trans('no'));
        $this->exclusive->addOption('yes', translator()->trans('yes'));
        $this->exclusive->getRenderer()->setSeparator('');
    }

    protected function initDates()
    {
        $this->addDateinput('valid_from', translator()->trans('valid_from'), false)
            ->addDateinput('valid_to', translator()->trans('valid_to'), false);
    }

    public function getDataFromModel()
    {
        $this->initUses();
        parent::getDataFromModel();
//        $this->initRaces();
//        $this->initValues();
    }

    protected function initUses()
    {
        if ($this->getModel()->id) {
            $this->addInput('uses', translator()->trans('uses'), false);
            $this->uses->setAttrib('readonly', 'readonly');
            $this->setElementOrder('uses', 'quantity');
        }
    }

    /**
     * @inheritdoc
     */
    public function process()
    {
        $this->saveToModel();
        $this->getModel()->saveRecord();
//        $this->getModel()->saveAmounts();
        return true;
    }

    public function saveToModel()
    {
        parent::saveToModel();

//        $racesIds = $this->races->getValue();
//        $this->getModel()->setOption('races', $racesIds);
//
//        foreach ($this->_currencies as $currency) {
//            $amount = $this->getElement('amounts[' . $currency->code . ']')->getValue();
//            $this->getModel()->getAmount($currency)->setValue($amount);
//        }
    }

    public function processValidation()
    {
        parent::processValidation();

        $this->validateCode();
        $this->validateUsageLimit();
        $this->validateValues();
        $this->validateDates();
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

    protected function validateUsageLimit()
    {
        if (!$this->usage_limit->isError()) {
            if (!is_numeric($this->usage_limit->getValue())) {
                $this->usage_limit->adderror($this->getModelMessage('usage_limit.bad'));
            }
        }
    }

    protected function validateValues()
    {
        foreach ($this->_currencies as $currency) {
            $name = 'amounts[' . $currency->code . ']';
            if (!$this->$name->isError()) {
                $value = $this->$name->getValue();
                if (!is_numeric($value)) {
                    $this->$name->addError(Discounts::instance()->getMessage('form.amount.nan'));
                } elseif ($this->type->getValue() == 'percentage' && abs($value) > 100) {
                    $this->$name->addError(Fee_Adjustments::instance()->getMessage('form.amount.percentage-toobig'));
                }
            }
        }
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

    protected function initRaces()
    {
        $races = $this->getModel()->getEvent()->getRaces();
        $this->addCheckboxGroup('races', Races::instance()->getLabel('title'), true);
        $this->races->getRenderer()->setSeparator('');
        foreach ($races as $race) {
            $this->races->addOption($race->id, $race->getName());
        }

        $this->races->setValue($this->getModel()->getOption('races'));
    }

    protected function initValues()
    {
        $this->_currencies = $this->getModel()->getEvent()->getCurrencies();
        foreach ($this->_currencies as $currency) {
            $name = 'amounts[' . $currency->code . ']';
            $this->addInput($name, translator()->trans('amount') . ' ' . $currency->code, true);
            $this->getElement($name)->setValue($this->getModel()->getAmount($currency)->getValue());
        }
    }
}