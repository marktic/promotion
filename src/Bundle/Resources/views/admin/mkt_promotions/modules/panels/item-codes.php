<?php

use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$codesRepository = PromotionModels::promotionCodes();
?>
<div class="card card-inverse">
    <div class="card-header">
        <h4 class="card-title">
            <?= Icons::list_ul(); ?>

            <?php echo $codesRepository->getLabel('title'); ?>
        </h4>
    </div>
    <?= $this->load('/mkt_promotion_codes/modules/lists/promotion', ['type' => 'edit']); ?>
</div>