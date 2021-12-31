<?php

/** @var PromotionAction $action */

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;

$configuration = $action->getConfiguration();
$currency = isset($currency) ? $currency : ($this->currency ?: null);
?>
<div class="badge bg-success">
    <strong>
        <?= PromotionModels::promotionActions()->translateType($action->getType()) ?>
    </strong>
    -
    <?= $configuration->getWithCurrency('amount', $currency); ?>%
</div>