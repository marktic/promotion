<?php
echo $this->Flash()->render($this->controller); ?>

<div class="row">
    <div class="col-md-7">
        <?= $this->load("modules/panels/item-entries"); ?>
    </div>
    <div class="col-md-5">
        <?= $this->load("modules/panels/item-details"); ?>
    </div>
</div>