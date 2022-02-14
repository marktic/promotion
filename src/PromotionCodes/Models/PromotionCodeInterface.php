<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasUsage\HasUsageInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\HasValidityInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;

interface PromotionCodeInterface extends HasUsageInterface, HasValidityInterface
{
    public function getPromotion(): ?PromotionInterface;
}