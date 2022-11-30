<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\PromotionSubjects;

use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionSubjects\Actions\PromotionCodes\RedeemPromotionCode;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectRecordTrait;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Record;

/**
 * @method PromotionSubjectInterface|PromotionSubjectRecordTrait|Record getModel()
 */
class RedeemPromotionCodeForm extends FormModel
{
    /**
     * @return RedeemPromotionCodeForm
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

        $this->addInput('redeem_code', translator()->trans('code'), true);

        $this->addButton('save', PromotionModels::promotionCodes()->getLabel('form.apply-btn'));
    }

    /**
     * @return void
     */
    public function processValidation()
    {
        parent::processValidation();
        $element = $this->getElement('redeem_code');
        if ($element->isError() || false === $element->hasValue()) {
            return;
        }

        $value = $element->getValue();
        try {
            (new RedeemPromotionCode())->for($this->getModel(), $value);
        } catch (InvalidPromotionalCode $exception) {
            $element->addError($exception->getMessage());
        }
    }

    /**
     * @return void
     */
    public function process()
    {
    }

    /**
     * @return void
     */
    protected function getDataFromModel()
    {
        $this->setAction($this->getModel()->compileURL('redeemPromotionCode'));

        parent::getDataFromModel();
    }
}
