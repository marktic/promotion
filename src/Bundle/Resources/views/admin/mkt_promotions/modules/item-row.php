<?php

/** @var CartPromotion $item */

use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionAction;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\Utility\PromotionModels;

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
        <?php
        foreach ($actions as $action) { ?>
            <?=
            $this->load(
                sprintf(
                    "/%s/modules/types/badge-%s",
                    PromotionModels::promotionActions()->getController(),
                    $action->getType()
                )
            );
            ?>
        <?php } ?>
    </td>
    <td>
    </td>
    <td>
        <?php
        echo translator()->trans($item->cumulative); ?>
    </td>
    <td>
        <?php
        echo _strftime($item->date_start); ?> /
        <?php
        echo _strftime($item->date_end); ?>
    </td>
</tr>