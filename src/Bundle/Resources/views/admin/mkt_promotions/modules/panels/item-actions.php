<?php

use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$actionsRepository = PromotionModels::promotionActions();
?>
<div class="card card-inverse">
    <div class="card-header">
        <h4 class="card-title">
            <?= Icons::list_ul(); ?>

            <?php echo $actionsRepository->getLabel('title'); ?>
        </h4>
    </div>
    <div class="card-body">
        <?= $this->load('/mkt_promotions_actions/modules/lists/promotion'); ?>
    </div>
</div>