<?php declare(strict_types=1);

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\View\View;

/** @var View $this */
/** @var PromotionAction $item */
$configuration = $item->getConfiguration();
$command = PromotionServices::actionCommands()->forAction($item);
?>
<div class="badge bg-light text-start text-dark w-100">
    <span class="d-block text-uppercase">
        <?= PromotionModels::promotionActions()->translateType($item->getType()); ?>
    </span>
    <span class="d-block mt-1 fw-light">
        <?= $command->describeConfiguration($configuration); ?>
    </span>
</div>