<?php

use Marktic\Promotion\Utility\PromotionModels;

$promotion_repository = PromotionModels::promotions();

?>
<table class="details table table-striped table-sm">
    <tbody>
    <tr>
        <td class="name"><?= translator()->trans('name'); ?>:</td>
        <td class="value"><?= $this->item->name; ?></td>
    </tr>
    <tr>
        <td class="name"><?= translator()->trans('code'); ?>:</td>
        <td class="value"><?= $this->item->code; ?></td>
    </tr>
    <tr>
        <td class="name">
            <?= $promotion_repository->getLabel('usage'); ?>:
        </td>
        <td class="value">
            <?= $this->item->used; ?> /
            <?= $this->item->usage_limit; ?>

            <a href="<?= $this->item->getRecalculateUsesURL() ?>" class="btn btn-xs btn-primary float-end">
                Recalculeaza
            </a>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= $promotion_repository->getLabel('exclusive'); ?>:
        </td>
        <td class="value"><?= $this->item->exclusive; ?></td>
    </tr>
    <tr>
        <td class="name">
            <?= $promotion_repository->getLabel('validity'); ?>:
        </td>
        <td class="value">
            FROM: <?= _strftime($this->item->valid_from); ?>
            <br/>
            TO: <?= _strftime($this->item->valid_from); ?>
        </td>
    </tr>
    </tbody>
</table>