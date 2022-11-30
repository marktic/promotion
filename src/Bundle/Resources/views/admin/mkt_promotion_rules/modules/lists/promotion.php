<?php declare(strict_types=1);

use Nip\View\View;

/* @var View $this */
$items ??= $this->get('promotion_rules');
$type ??= 'view';
?>
<?php foreach ($items as $item) { ?>
    <?= $this->load(
    '/mkt_promotion_rules/modules/item/' . $type,
    [
            'item' => $item,
        ]
);
    ?>
<?php } ?>