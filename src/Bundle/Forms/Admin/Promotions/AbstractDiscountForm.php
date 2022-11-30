<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasAmounts;
use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotion;

/**
 * @method CartPromotion getModel()
 */
abstract class AbstractDiscountForm extends AbstractForm
{
    use FormHasAmounts;

    protected $promotionAction = null;

    /**
     * @return void
     */
    public function getDataFromModel()
    {
        parent::getDataFromModel();
        $this->getDataFromModelForAmounts();
    }

    /**
     * @return void
     */
    public function processValidation()
    {
        parent::processValidation();

        $this->validateAmounts();
    }

    /**
     * @return void
     */
    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelAmounts();
    }

    /**
     * @return void
     */
    public function saveModel()
    {
        parent::saveModel();
        $this->getModel()->getPromotionActions()->save();
    }

    protected function getModelAmounts()
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        return $this->getPromotionAction();
    }

    /**
     * @return null
     *
     * @throws \Exception
     */
    public function getPromotionAction()
    {
        if (null === $this->promotionAction) {
            $this->promotionAction = $this->generatePromotionAction();
        }

        return $this->promotionAction;
    }

    /**
     * @throws \Exception
     */
    protected function generatePromotionAction()
    {
        $actions = $this->getModel()->getPromotionActions();
        if (1 !== \count($actions)) {
            throw new \Exception('There must be one action in the promotion');
        }

        return $actions->current();
    }
}
