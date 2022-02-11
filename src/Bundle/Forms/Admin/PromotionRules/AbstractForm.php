<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\PromotionRules;

use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;

/**
 * @method PromotionAction getModel()
 */
abstract class AbstractForm extends FormModel
{
    public function initialize()
    {
        parent::initialize();

        $this->setAttrib('id', 'mkt-promotion-rules-form');
        $this->addButton('save', translator()->trans('submit'));
    }

}