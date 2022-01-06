<?php

/** @var PromotionAction $item */

use ByTIC\Icons\Icons;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;
use Marktic\Promotion\Utility\PromotionServices;

$configuration = $item->getConfiguration();
$command = PromotionServices::actionCommands()->forAction($item);
$actionUrl = $item->compileURL('edit');
?>
<div class="bg-light text-start text-dark d-flex p-3">
    <div class="name flex-grow-1">
        <h6 class="d-block text-uppercase fw-bold">
            <?= PromotionModels::promotionActions()->translateType($item->getType()) ?>
        </h6>
        <span class="badge bg-success mt-1 fw-light fs-6">
            <?= $command->describeConfiguration($configuration); ?>
        </span>
    </div>
    <div class="actions">
        <a href="<?= $actionUrl ?>" data-href="<?= $actionUrl ?>"
           data-bs-toggle="modalForm" data-bs-target="#modalForm"
           class="btn btn-outline-primary btn-xs float-end">
            <?= Icons::edit(); ?>
        </a>
    </div>
</div>