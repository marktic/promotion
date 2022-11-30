<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\Promotions;

use Marktic\Promotion\PromotionCodes\Generator\Codes\UniqueCodeGenerator;

class AutomaticForm extends AbstractDiscountForm
{
    protected function initCode(): void
    {
    }

    public function saveToModel()
    {
        parent::saveToModel();

        if (empty($this->getModel()->getCode())) {
            $this->getModel()->setCode(
                UniqueCodeGenerator::oneFor()
            );
        }
    }
}
