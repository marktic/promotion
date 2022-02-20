<?php

namespace Marktic\Promotion\PromotionCodes\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasCode\HasCodeInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasId\HasIdInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\HasUsageInterface;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\HasValidityInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;

interface PromotionCodeInterface extends HasUsageInterface, HasValidityInterface, HasCodeInterface, HasIdInterface
{
    public function getPromotion(): ?PromotionInterface;
}