<?php declare(strict_types=1);

use Marktic\Promotion\PromotionRules\Models\PromotionRule;
use Nip\View\View;

/** @var View $this */
/** @var null|PromotionRule[] $items */
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