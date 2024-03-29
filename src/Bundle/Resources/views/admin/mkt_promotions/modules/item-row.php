<?php declare(strict_types=1);

use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionAction;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Nip\View\View;

/**
 * @var View              $this
 * @var CartPromotion     $item
 * @var PromotionAction[] $actions
 */
$actions = $item->getPromotionActions();
?>
<tr>
    <td>
        <a href="<?= $item->getURL(); ?>" title="">
            <?= $item->getName(); ?>
        </a>
    </td>
    <td><?= $item->getTypeObject()->getLabelHTML(); ?></td>
    <td><?= $item->getCode(); ?></td>
    <td>
        <?= $item->getUsed(); ?> /
        <?= $item->getUsageLimit(); ?>
    </td>
    <td>
        <?= $this->load('/mkt_promotion_actions/modules/lists/promotion', ['actions' => $actions]); ?>
    </td>
    <td>
        <?= translator()->trans($item->isExclusive() ? 'yes' : 'no'); ?>
    </td>
    <td>
        <?= $this->load('/mkt_base/modules/validity', ['item' => $item]); ?>
    </td>
</tr>