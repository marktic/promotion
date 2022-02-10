<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasUsage\HasUsageInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\HasValidityInterface;

interface PromotionCodeInterface extends HasUsageInterface, HasValidityInterface
{

}