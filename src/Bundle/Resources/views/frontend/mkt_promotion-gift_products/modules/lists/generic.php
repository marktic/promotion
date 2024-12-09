<?php

/** @var GiftProduct $items */

use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\Utility\PromotionModels;

$items = $items ?? ($this->get('items') ?? []);
?>

<?php if (count($items) < 1) : ?>
    <?= $this->Messages()->info(
        PromotionModels::giftProducts()->getMessage('dnx')
    ) ?>
    <?php return; ?>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php foreach ($items as $item) : ?>
        <div class="col">
            <?= $this->load('/mkt_promotion-gift_products/modules/item/card', ['item' => $item]) ?>
        </div>
    <?php endforeach; ?>
</div>
