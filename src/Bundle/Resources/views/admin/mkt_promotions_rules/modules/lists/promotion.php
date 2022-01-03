<?php

$items = $items ?? $this->promotion_rules;
$type = $type ?? 'view';
?>
<?php foreach ($items as $action) { ?>
    <?=
    $this->load(
        "/mkt_promotions_rules/modules/item/" . $type,
        [
            'item' => $action
        ]
    );
    ?>
<?php } ?>