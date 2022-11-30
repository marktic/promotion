<?php declare(strict_types=1);

use ByTIC\Icons\Icons;
use Marktic\Promotion\Bundle\Models\PromotionRules\PromotionRule;
use Marktic\Promotion\Utility\PromotionModels;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\View\View;

/* @var View $this */
/* @var PromotionRule $item */
$configuration = $item->getConfiguration();
$condition = PromotionServices::ruleConditions()->forRule($item);
$actionUrl = $item->compileURL('edit');
?>
<div class="bg-white text-start text-dark rounded shadow-xs d-flex p-3">
    <div class="name flex-grow-1">
        <span class="d-block text-uppercase">
            <?= PromotionModels::promotionRules()->translateType($item->getType()); ?>
        </span>
        <span class="d-block mt-1 fw-light">
        <?= $condition->describeConfiguration($configuration); ?>
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