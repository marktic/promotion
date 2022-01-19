<?php

use Marktic\Promotion\PromotionRules\Models\PromotionRule;
use Marktic\Promotion\Utility\PromotionModels;
use Marktic\Promotion\Utility\PromotionServices;

/** @var PromotionRule $item */

$configuration = $item->getConfiguration();
$condition = PromotionServices::ruleConditions()->forRule($item);
?>
<div class="bg-light text-start text-dark d-flex p-3">
    <span class="d-block text-uppercase">
        <?= PromotionModels::promotionRules()->translateType($item->getType()) ?>
    </span>
    <span class="d-block mt-1 fw-light">
        <?= $condition->describeConfiguration($configuration); ?>
    </span>
</div>