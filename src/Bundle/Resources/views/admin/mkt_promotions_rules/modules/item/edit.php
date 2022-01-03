<?php

/** @var PromotionAction $item */

use ByTIC\Icons\Icons;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;

$configuration = $item->getConfiguration();
?>
<div class="badge bg-light text-start text-dark d-flex">
    <div class="name flex-grow-1">
        <span class="d-block text-uppercase">
            <?= PromotionModels::promotionRules()->translateType($item->getType()) ?>
        </span>
        <span class="d-block mt-1 fw-light">
        </span>
    </div>
    <a href="<?= $item->compileURL('edit'); ?>" class="btn btn-outline-primary btn-xs float-end">
        <?= Icons::edit(); ?>
    </a>
</div>