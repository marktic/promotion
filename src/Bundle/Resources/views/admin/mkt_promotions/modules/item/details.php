<?php

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\Utility\PromotionModels;

$promotion_repository = PromotionModels::promotions();

/** @var CartPromotion $item */
$item = $this->item;
?>
<table class="details table table-striped table-sm">
    <tbody>
    <tr>
        <td class="name"><?= translator()->trans('name'); ?>:</td>
        <td class="value">
            <?= $item->getName(); ?>
        </td>
    </tr>
    <tr>
        <td class="name"><?= translator()->trans('code'); ?>:</td>
        <td class="value"><?= $item->code; ?></td>
    </tr>
    <tr>
        <td class="name">
            <?= $promotion_repository->getLabel('usage'); ?>:
        </td>
        <td class="value">
            <?= $item->getUsed(); ?> /
            <?= $item->getUsageLimit(); ?>

            <a href="<?= $item->getRecalculateUsesURL() ?>" class="btn btn-xs btn-primary float-end">
                Recalculeaza
            </a>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= $promotion_repository->getLabel('exclusive'); ?>:
            <small class="d-block">
                <?= $promotion_repository->getLabel('exclusive.help'); ?>
            </small>
        </td>
        <td class="value">
            <?= translator()->trans($item->isExclusive() ? 'yes' : 'no'); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= $promotion_repository->getLabel('validity'); ?>:
        </td>
        <td class="value">
            FROM: <?= _strftime($item->valid_from); ?>
            <br/>
            TO: <?= _strftime($item->valid_from); ?>
        </td>
    </tr>
    </tbody>
</table>