<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Exception;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasAmounts;

abstract class AbstractDiscountForm extends AbstractForm
{
    protected $promotionAction = null;

    use FormHasAmounts;

    public function getDataFromModel()
    {
        parent::getDataFromModel();
        $this->getDataFromModelForAmounts();
    }

    public function processValidation()
    {
        parent::processValidation();

        $this->validateAmounts();
    }

    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelAmounts();
    }

    /**
     * @inheritdoc
     */
    public function saveModel()
    {
        parent::saveModel();
        $this->getModel()->getPromotionActions()->save();
    }

    protected function getModelAmounts()
    {
        return $this->getPromotionAction();
    }

    /**
     * @return null
     */
    public function getPromotionAction()
    {
        if ($this->promotionAction === null) {
            $this->promotionAction = $this->generatePromotionAction();
        }

        return $this->promotionAction;
    }

    protected function generatePromotionAction()
    {
        $actions = $this->getModel()->getPromotionActions();
        if (count($actions) !== 1) {
            throw new Exception('There must be one action in the promotion');
        }

        return $actions->current();
    }
}