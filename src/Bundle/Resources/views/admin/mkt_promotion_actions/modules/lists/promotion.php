<?php

use Nip\View\View;

/** @var View $this */

$actions = $actions ?? $this->get('promotion_actions');
$type = $type ?? 'view';
?>
<?php foreach ($actions as $action) { ?>
    <?=
    $this->load(
        "/mkt_promotion_actions/modules/item/" . $type,
        ['item' => $action]
    );
    ?>
<?php } ?>