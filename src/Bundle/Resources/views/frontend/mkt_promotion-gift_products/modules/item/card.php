<?php

use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\Utility\PromotionModels;

/** @var GiftProduct $item */
$item = $item ?? ($this->get('item') ?? null);
$priceCalculator = $this->get('priceCalculator');
$amount = $priceCalculator->for($item);
?>
<div class="card">
    <div class="card-img-top position-relative">
        <img src="<?= $item->getImage() ?>" class="img-fluid" alt="<?= $item->getName() ?>">
        <span class="badge rounded-pill text-bg-primary position-absolute top-0 end-0 mt-2 me-2">
            <?= $item->getTypeObject()->getLabel() ?>
        </span>
    </div>
    <div class="card-body">
        <h5 class="card-title fw-bold text-primary">
            <?= $item->getName() ?>
        </h5>
        <p class="card-text">
            <?= $item->getDescription() ?>
        </p>
        <div class="row">
            <div class="col fs-4">
                <?= $amount->formatByHtml(); ?>
            </div>
            <div class="col text-end">
                <a href="<?= $item->compileURL('buy'); ?>" class="btn btn-primary btn-outline">
                    <?= PromotionModels::giftProducts()->getLabel('buy'); ?>
                </a>
            </div>
        </div>
    </div>
</div>