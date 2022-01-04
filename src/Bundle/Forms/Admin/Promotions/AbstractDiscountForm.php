<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasAmounts;

abstract class AbstractDiscountForm extends AbstractForm
{
    use FormHasAmounts;

    public function getDataFromModel()
    {
        parent::getDataFromModel();
        $this->initAmounts();
    }
}