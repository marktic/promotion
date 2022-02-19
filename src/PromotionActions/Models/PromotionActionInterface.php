<?php

namespace Marktic\Promotion\PromotionActions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\HasConfigurationInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasId\HasIdInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasType\HasTypeInterface;

interface PromotionActionInterface extends HasTypeInterface, HasConfigurationInterface, HasIdInterface
{
}