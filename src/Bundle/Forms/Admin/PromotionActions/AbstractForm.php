<?php

declare(strict_types=1);

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
    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelAmounts();
    }

    /**
     * @return void
     */
    public function processValidation()
    {
        parent::processValidation();
        $this->validateAmounts();
    }
}
