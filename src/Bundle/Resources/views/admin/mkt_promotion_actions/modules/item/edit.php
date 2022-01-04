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
<div class="badge bg-light text-start text-dark d-flex">
    <div class="name flex-grow-1">
        <span class="d-block text-uppercase">
            <?= PromotionModels::promotionActions()->translateType($item->getType()) ?>
        </span>
        <span class="d-block mt-1 fw-light">
            <?= $command->describeConfiguration($configuration); ?>
        </span>
    </div>
    <a href="<?= $actionUrl ?>" data-href="<?= $actionUrl ?>"
       data-bs-toggle="modalForm" data-bs-target="#modalForm"
       class="btn btn-outline-primary btn-xs float-end">
        <?= Icons::edit(); ?>
    </a>
</div>