<?php declare(strict_types=1);

use ByTIC\Icons\Icons;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\View\View;

/* @var View $this */
/* @var PromotionAction $item */
$configuration = $item->getConfiguration();
$command = PromotionServices::actionCommands()->forAction($item);
$actionUrl = $item->compileURL('edit');
?>
<div class="bg-white text-start text-dark rounded shadow-xs d-flex p-3">
    <div class="name flex-grow-1">
        <h6 class="d-block text-uppercase fw-bold">
            <?= PromotionModels::promotionActions()->translateType($item->getType()); ?>
        </h6>
        <span class="badge bg-success mt-1 fw-light fs-6">
            <?= $command->describeConfiguration($configuration); ?>
        </span>
    </div>
    <div class="actions">
        <a href="<?= $actionUrl; ?>" data-href="<?= $actionUrl; ?>"
           data-bs-toggle="modalForm" data-bs-target="#modalForm"
           class="btn btn-outline-primary btn-xs float-end">
            <?= Icons::edit(); ?>
        </a>
    </div>
</div>