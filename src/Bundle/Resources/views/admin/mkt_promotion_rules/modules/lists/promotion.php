<?php

use Nip\View\View;

/** @var View $this */

$items = $items ?? $this->get('promotion_rules');
$type = $type ?? 'view';
?>
<?php foreach ($items as $item) { ?>
    <?=
    $this->load(
        "/mkt_promotion_rules/modules/item/" . $type,
        [
            'item' => $item
        ]
    );
    ?>
<?php } ?>