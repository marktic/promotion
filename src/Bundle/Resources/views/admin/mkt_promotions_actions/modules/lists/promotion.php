<?php

$actions = $actions ?? $this->promotion_actions;
?>
<?php foreach ($actions as $action) { ?>
    <?=
    $this->load(
        "/mkt_promostions_actions/modules/item/view",
        [
            'item' => $action
        ]
    );
    ?>
<?php } ?>