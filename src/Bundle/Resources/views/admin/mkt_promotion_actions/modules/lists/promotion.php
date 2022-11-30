<?php declare(strict_types=1);

use Nip\View\View;

/** @var View $this */
$actions ??= $this->get('promotion_actions');
$type ??= 'view';
?>
<?php foreach ($actions as $action) { ?>
    <?= $this->load(
    '/mkt_promotion_actions/modules/item/' . $type,
    ['item' => $action]
);
    ?>
<?php } ?>