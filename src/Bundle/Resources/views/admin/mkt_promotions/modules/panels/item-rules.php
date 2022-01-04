<?php

use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$rulesRepository = PromotionModels::promotionRules();
?>
<div class="card card-inverse">
    <div class="card-header">
        <h4 class="card-title">
            <?= Icons::list_ul(); ?>

            <?php echo $rulesRepository->getLabel('title'); ?>
        </h4>
    </div>
    <?= $this->load('/mkt_promotion_rules/modules/lists/promotion'); ?>
</div>