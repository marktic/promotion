<?php

/** @var CartPromotion $item */

use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionAction;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;

/** @var PromotionAction[] $actions */
$actions = $item->getPromotionActions();
?>
<tr>
    <td>
        <a href="<?= $item->getURL(); ?>" title="">
            <?= $item->getName(); ?>
        </a>
    </td>
    <td><?= $item->code; ?></td>
    <td>
        <?= $item->getUsed(); ?> /
        <?= $item->getUsageLimit(); ?>
    </td>
    <td>
        <?= $this->load('/mkt_promotion_actions/modules/lists/promotion', ['actions' => $actions]); ?>
    </td>
    <td>
    </td>
    <td>
        <?= translator()->trans($item->isExclusive() ? 'yes' : 'no'); ?>
    </td>
    <td>
        <?= $item->getValidFrom(); ?> /
        <?= $item->getValidTo(); ?>
    </td>
</tr>