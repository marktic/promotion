<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\PromotionCodes;

use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasCode;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasDates;
use Marktic\Promotion\Bundle\Forms\Admin\AbstractForms\FormHasUsage;
use Marktic\Promotion\Bundle\Library\Form\FormModel;

abstract class AbstractForm extends FormModel
{
    use FormHasCode;
    use FormHasDates;
    use FormHasUsage;

    public function initialize()
    {
        parent::initialize();

        $this->setAttrib('id', 'mkt-promotion-code-form');

        $this->initCode();
        $this->initUsage();
        $this->initDates();

        $this->addButton('save', translator()->trans('submit'));
    }

    public function processValidation()
    {
        parent::processValidation();

        $this->validateCode();
        $this->validateUsageLimit();
        $this->validateDates();
    }

    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelDates();
    }
}
