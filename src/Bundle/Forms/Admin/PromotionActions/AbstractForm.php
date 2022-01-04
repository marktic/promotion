<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\PromotionActions;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasAmounts;
use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;

/**
 * @method PromotionAction getModel()
 */
abstract class AbstractForm extends FormModel
{
    use FormHasAmounts;

    public function initialize()
    {
        parent::initialize();

        $this->setAttrib('id', 'mkt-promotion-form');

        $this->addButton('save', translator()->trans('submit'));
    }

    public function getDataFromModel()
    {
        parent::getDataFromModel();
        $this->getDataFromModelForAmounts();
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
        $this->saveToModelAmounts();
    }

    public function processValidation()
    {
        parent::processValidation();

        $this->validateAmounts();
    }

    protected function getDataFromModelForAmount($input, $type = null)
    {
        $configuration = $this->getModel()->getConfiguration();
        $value = $configuration->getWithCurrency('amount', $type);
        $input->setValue($value);
    }

    protected function saveToModelAmount($amount, $type)
    {
        $configuration = $this->getModel()->getConfiguration();
        $configuration->setWithCurrency('amount', $amount, $type);
    }
}