<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Admin\PromotionRules;

use Marktic\Promotion\PromotionRules\Conditions\ItemTotalRuleCondition;
use Marktic\Promotion\Utility\PromotionModels;

class ItemTotalForm extends AbstractForm
{
    protected $configs = [
        ItemTotalRuleCondition::CONF_MIN_ITEMS,
        ItemTotalRuleCondition::CONF_MIN_ITEMS,
    ];
    protected $repository;

    public function initialize()
    {
        parent::initialize();

        $this->repository = PromotionModels::promotionRules();

        foreach ($this->configs as $config) {
            $this->initializeElement($config);
        }
    }

    protected function initializeElement($name)
    {
        $this->addNumber(
            $name,
            $this->repository->getLabel('rule.' . ItemTotalRuleCondition::NAME . '.' . $name),
            true
        );
    }

    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelConfig();
    }

    protected function saveToModelConfig()
    {
        foreach ($this->configs as $config) {
            $element = $this->getElement($config);

            $value = $element->getValue('model');
            $this->getModel()->getConfiguration()->set($config, $value);
        }
    }

    protected function getDataFromModel()
    {
        parent::getDataFromModel();
        $this->getDataFromModelConfig();
    }

    protected function getDataFromModelConfig()
    {
        foreach ($this->configs as $config) {
            $element = $this->getElement($config);
            $element->getData($this->getModel()->getConfiguration()->get($config), 'model');
        }
    }
}
