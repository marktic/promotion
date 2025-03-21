<?php declare(strict_types=1);

use Nip\View\View;

/** @var View $this */
?>
<div class="d-grid gap-3">
    <?= $this->Flash()->render($this->get('controller')); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $this->load('/mkt_promotions/modules/panels/item-details'); ?>
        </div>
        <div class="col-md-4">
            <?= $this->load('/mkt_promotions/modules/panels/item-actions'); ?>
        </div>
        <div class="col-md-4">
            <?= $this->load('/mkt_promotions/modules/panels/item-rules'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $this->load('/mkt_promotions/modules/panels/item-codes'); ?>
        </div>
        <div class="col-md-8">
            <?= $this->load('/mkt_promotions/modules/panels/item-sessions'); ?>
        </div>
    </div>

</div>
