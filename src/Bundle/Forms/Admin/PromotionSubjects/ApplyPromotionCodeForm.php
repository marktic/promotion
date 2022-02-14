<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\PromotionSubjects;

use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\PromotionCodes\Actions\FindAndValidatePromotionCode;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectRecordTrait;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Record;


/**
 * @method PromotionSubjectInterface|PromotionSubjectRecordTrait|Record getModel()
 */
class ApplyPromotionCodeForm extends FormModel
{
    /**
     * @param PromotionSubjectInterface|Record $subject
     * @return ApplyPromotionCodeForm
     */
    public static function for(PromotionSubjectInterface $subject)
    {
        $form = new self();
        $form->setModel($subject);
        return $form;
    }

    public function initialize()
    {
        parent::initialize();
        $this->setOption('render_messages', false);

        $this->addInput('code', translator()->trans('code'), true);

        $this->addButton('save', PromotionModels::promotionCodes()->getLabel('form.apply-btn'));
    }

    public function processValidation()
    {
        parent::processValidation();
        $element = $this->getElement('code');
        if ($element->isError() || false === $element->hasValue()) {
            return;
        }

        $value = $element->getValue();
        try {
            $promotionCode = FindAndValidatePromotionCode::for($this->getModel(), $value);
        } catch (InvalidPromotionalCode $exception) {
            $element->addError($exception->getMessage());
        }
    }

    public function process()
    {
//        $this->_discount->addUse($this->getModel());
//        $this->getModel()->update();
    }

    protected function getDataFromModel()
    {
        $this->setAction($this->getModel()->compileURL('applyPromotionCode'));

        parent::getDataFromModel();
    }
}