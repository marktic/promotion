<?php

use ByTIC\Icons\Icons;

?>
<div class="card card-inverse">
    <div class="card-header">
        <h4 class="card-title">
            <?= Icons::list_ul(); ?>

            <?php echo translator()->trans('details'); ?>
        </h4>
        <a href="<?php echo $this->item->getEditURL(); ?>" class="btn btn-info btn-xs">Edit</a>
    </div>
    <?= $this->load("/mkt_promotions/modules/item/details"); ?>
</div>