<?php

declare(strict_types=1);

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

    protected function initAmounts(): void
    {
        $this->initPromotionCurrencies();
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $this->initAmount($currency);
        }
    }

    protected function initAmount($type = null): void
    {
        $name = $type ? 'amounts[' . $type . ']' : 'amount';

        $this->addNumber($name, translator()->trans('amount') . ' ' . $type, true);
        $input = $this->getElement($name);
        $input->setAttrib('step', '.01');
        $input->setAttrib('min', '0');
    }

    protected function getDataFromModelForAmounts(): void
    {
        $this->initAmounts();
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $input = $this->getAmountElement($currency);
            $value = $this->getDataFromModelForAmount($currency);
            $input->setValue($value);
        }
    }

    protected function getAmountElement($type = null): ?AbstractElement
    {
        $name = $type ? 'amounts[' . $type . ']' : 'amount';

        return $this->getElement($name);
    }

    protected function getDataFromModelForAmount($type = null)
    {
        $configuration = $this->getModelAmounts()->getConfiguration();

        return $configuration->getWithCurrency('amount', $type);
    }

    protected function validateAmounts(): void
    {
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $this->validateAmount($currency);
        }
    }

    /**
     * @return void
     */
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

        if ('percentage' == $this->amountType() && abs($value) > 100) {
            $input->addError(PromotionModels::promotionActions()->getMessage('form.amount.percentage-toobig'));
        }
    }

    protected function saveToModelAmounts(): void
    {
        $currencies = $this->getPromotionCurrenciesCodes();
        foreach ($currencies as $currency) {
            $amount = $this->getAmountElement($currency)->getValue();
            $this->saveToModelAmount($amount, $currency);
        }
    }

    protected function saveToModelAmount($amount, $type): void
    {
        $configuration = $this->getModelAmounts()->getConfiguration();
        $configuration->setWithCurrency('amount', $amount, $type);
    }

    protected function getModelAmounts(): \Marktic\Promotion\PromotionActions\Models\PromotionAction
    {
        return $this->getModel();
    }

    protected function initPromotionCurrencies(): void
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
            return \is_object($currency) ? $currency->code : $currency;
        }, $currencies);
    }

    protected function hasPromotionCurrencies(): bool
    {
        return is_countable($this->currencies) && \count($this->currencies) > 0;
    }

    protected function amountType(): string
    {
        return 'money';
    }
}
