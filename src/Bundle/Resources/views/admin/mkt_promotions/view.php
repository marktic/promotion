<div class="d-grid gap-3">

    <?= $this->Flash()->render($this->controller); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $this->load("modules/panels/item-details"); ?>
        </div>
        <div class="col-md-4">
            <?= $this->load("modules/panels/item-actions"); ?>
        </div>
        <div class="col-md-4">
            <?= $this->load("modules/panels/item-rules"); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <?= $this->load("modules/panels/item-codes"); ?>
        </div>
        <div class="col-md-7">
        </div>
    </div>

</div>
