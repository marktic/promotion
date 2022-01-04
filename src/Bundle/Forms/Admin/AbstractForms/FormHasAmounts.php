<?php

namespace Marktic\Promotion\Bundle\Forms\Admin\AbstractForms;

use Marktic\Promotion\Base\Models\PromotionPools\PromotionPoolWithCurrencies;
use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotion;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Form\Elements\AbstractElement;

/**
 * @method CartPromotion|PromotionAction getModel
 */
trait FormHasAmounts
{
    protected $currencies;

    protected function initAmounts()
    {
        $this->initPromotionCurrencies();
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $this->initAmount($currency);
        }
    }

    protected function initPromotionCurrencies()
    {
        $pool = $this->getModel()->getPromotionPool();
        if (!method_exists($pool, PromotionPoolWithCurrencies::CURRENCIES_METHOD)) {
            $this->currencies = [];
        }
        $this->currencies = $pool->getPromotionPoolCurrencies();
    }

    protected function getPromotionCurrenciesCodes(): array
    {
        $currencies = $this->hasPromotionCurrencies() ? $this->currencies : [null];
        return array_map(function ($currency) {
            return is_object($currency) ? $currency->code : $currency;
        }, $currencies);
    }

    protected function hasPromotionCurrencies(): bool
    {
        return is_countable($this->currencies) && count($this->currencies) > 0;
    }

    protected function initAmount($type = null)
    {
        $name = $type ? 'amounts[' . $type . ']' : 'amount';

        $this->addNumber($name, translator()->trans('amount') . ' ' . $type, true);
        $input = $this->getElement($name);
        $input->setAttrib('step', '.01');
        $input->setAttrib('min', '0');
    }

    protected function getDataFromModelForAmounts()
    {
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $input = $this->getAmountElement($currency);
            $this->getDataFromModelForAmount($input, $currency);
        }
    }

    protected function getAmountElement($type = null): ?AbstractElement
    {
        $name = $type ? 'amounts[' . $type . ']' : 'amount';
        return $this->getElement($name);
    }

    protected function getDataFromModelForAmount($input, $type = null)
    {
    }

    protected function validateAmounts()
    {
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $this->validateAmount($currency);
        }
    }

    protected function validateAmount($type)
    {
        $input = $this->getAmountElement($type);
        if ($input->isError()) {
            return;
        }
        $value = $input->getValue();
        if (!is_numeric($value)) {
            $input->addError(PromotionModels::promotionActions()->getMessage('form.amount.nan'));
            return;
        }

        if ($this->amountType() == 'percentage' && abs($value) > 100) {
            $input->addError(PromotionModels::promotionActions()->getMessage('form.amount.percentage-toobig'));
        }
    }

    protected function amountType(): string
    {
        return 'money';
    }
}
