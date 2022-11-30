<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\HasConfigurationInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasType\HasTypeInterface;

interface PromotionRuleInterface extends HasTypeInterface, HasConfigurationInterface
{
}
