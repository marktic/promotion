<?php

$actions = $actions ?? $this->promotion_actions;
$type = $type ?? 'view';
?>
<?php foreach ($actions as $action) { ?>
    <?=
    $this->load(
        "/mkt_promotions_actions/modules/item/" . $type,
        [
            'item' => $action
        ]
    );
    ?>
<?php } ?>