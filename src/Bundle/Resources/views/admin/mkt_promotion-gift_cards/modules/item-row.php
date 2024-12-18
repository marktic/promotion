<?php declare(strict_types=1);

use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionAction;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Nip\View\View;

/**
 * @var View $this
 * @var GiftCard $item
 */
$configuration = $item->getConfiguration();
?>
<tr>
    <td>
        <a href="<?= $item->getURL(); ?>" title="">
            <?= $item->getUuid(); ?>
        </a>
    </td>
    <td>
        <?= $item->getGiftProduct()->getName(); ?>
    </td>
    <td><?= $configuration->getSender()->toHTML(); ?></td>
    <td><?= $configuration->getRecipient()->toHTML(); ?></td>
    <td>
        STATUS
    </td>
    <td>
        <?= $item->created_at; ?>
    </td>
</tr>