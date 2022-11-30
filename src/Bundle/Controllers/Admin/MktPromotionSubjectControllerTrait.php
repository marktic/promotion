<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Controllers\Admin;

use ByTIC\Controllers\Behaviors\Models\HasModelLister;
use Marktic\Promotion\Bundle\Forms\Admin\PromotionSubjects\RedeemPromotionCodeForm;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PromotionModels;
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
            PromotionModels::promotions()->getMessage('form.register.success'),
            $redirectUrl,
            'success'
        );
    }
}
