<?php

use Marktic\Promotion\Utility\PromotionModels;

/** @var \Marktic\Promotion\PromotionCodes\Models\PromotionCode $promotion_code */
$promotion_code = $this->get('promotion_code');
?>
<?php if (!$promotion_code) { ?>
    <?= $this->Messages()->info(PromotionModels::giftProducts()->getMessage('promotion_code.dnx')) ?>
    <?php return; ?>
<?php } ?>
<?php
$promotion = $promotion_code->getPromotion();
?>
<table class="details table table-striped table-sm">
    <tbody>
    <tr>
        <td class="">
            <?= PromotionModels::promotions()->getLabel('title.singular'); ?>
        </td>
        <td class="">
            <a href="<?= $promotion->getURL(); ?>" >
                <?= $promotion->getName() ?>
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <?= PromotionModels::promotionCodes()->getLabel('title.singular'); ?>
        </td>
        <td>
            <a href="<?= $promotion_code->getURL(); ?>" >
                <?= $promotion_code->getPromotion()->getCode() ?>
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('uses'); ?>
        </td>
        <td>
            <?= $promotion_code->getUsed(); ?> /
            <?= $promotion_code->getUsageLimit(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= PromotionModels::promotions()->getLabel('validity'); ?>
        </td>
        <td>
                <?= $this->load('/mkt_base/modules/validity', ['item' => $promotion_code]); ?>
        </td>
    </tr>
    </tbody>
</table>