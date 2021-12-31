<?php

/** @var PromotionAction $action */

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;

$configuration = $action->getConfiguration();
$currency = isset($currency) ? $currency : ($this->currency ?: null);
$currencies = $configuration->get('amount_c', []);
?>
<div class="badge bg-light   text-dark w-100">
    <span class="d-block text-uppercase">
        <?= PromotionModels::promotionActions()->translateType($action->getType()) ?>
    </span>
    <span class="d-block mt-1 fw-light">

    - <?= $configuration->getWithCurrency('amount', $currency); ?>%
    <?php foreach ($currencies as $currency => $value) { ?>
        | <?= $currency ?>: -<?= $value ?>%
    <?php } ?>
    </span>
</div>