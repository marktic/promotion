<?php

use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\Utility\PromotionModels;

/** @var GiftProduct $item */
$item = $item ?? ($this->get('item') ?? null);
$priceCalculator = $this->get('priceCalculator');
$amount = $priceCalculator->for($item);
?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <?= $item->getName() ?>
        </h5>
        <p class="card-text">
            <?= $item->getDescription() ?>
        </p>
        <p>
            Price: <?= $amount->format() ?>
        </p>
        <a href="<?= $item->compileURL('buy'); ?>" class="btn btn-primary">
            <?= PromotionModels::giftProducts()->getLabel('buy'); ?>
        </a>
    </div>
</div>