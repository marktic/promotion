<?php

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\HasConfigurationInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasType\HasTypeInterface;

interface PromotionRuleInterface extends HasTypeInterface, HasConfigurationInterface
{

}