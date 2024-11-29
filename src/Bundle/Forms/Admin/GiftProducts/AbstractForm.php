<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\GiftProducts;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasCode;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasDates;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasUsage;
use Marktic\Promotion\Bundle\Library\Form\FormModel;
use Marktic\Promotion\Utility\PromotionModels;

abstract class AbstractForm extends FormModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setAttrib('id', 'mkt-promotion-form');

        $this->addInput('name', translator()->trans('name'), true);

        $this->addButton('save', translator()->trans('submit'));
    }

}
