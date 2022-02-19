<?php

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionSubjects\RedeemPromotionCodeForm;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\Records\Record;

/**
 * @method PromotionSubjectInterface|Record getModelFromRequest()
 */
trait MktPromotionSubjectControllerTrait
{
    use AbstractControllerTrait;
    use HasModelLister;

    public function redeemPromotionCode()
    {
        $subject = $this->getModelFromRequest();

        $redirectUrl = $subject->compileURL('view');

        $formDiscount = RedeemPromotionCodeForm::for($subject);
        if (false === $formDiscount->execute()) {
            $this->flashRedirect($formDiscount->getMessages(), $redirectUrl, 'error');
        }

        $this->flashRedirect(
            $this->getModelManager()->getMessage('form.register.success'),
            $redirectUrl,
            'success'
        );
    }

}