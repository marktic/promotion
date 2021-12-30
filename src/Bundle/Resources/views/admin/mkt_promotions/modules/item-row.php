<?php

/** @var CartPromotion $item */

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionActions\Presentation\ActionHtml;

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
        <?= $actions->map(function ($action) {
            return ActionHtml::for($action);
        })->implode(' '); ?>
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