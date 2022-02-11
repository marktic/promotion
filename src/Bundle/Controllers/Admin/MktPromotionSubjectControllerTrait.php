<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionSubjects\ApplyPromotionCodeForm;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\Records\Record;

/**
 * @method PromotionSubjectInterface|Record getModelFromRequest()
 */
trait MktPromotionSubjectControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    public function applyPromotionCode()
    {
        $subject = $this->getModelFromRequest();

        $redirectUrl = $subject->compileURL('view');

        $formDiscount = ApplyPromotionCodeForm::for($subject);
        if (false === $formDiscount->execute()) {
            $this->flashRedirect($formDiscount->getMessages(), $redirectUrl, 'error');
        }

        $this->flashRedirect('Promotion code applied', $redirectUrl, 'success');
    }

}