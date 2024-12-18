<?php declare(strict_types=1);

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$promotion_repository = PromotionModels::giftCards();

/** @var GiftCard $item */
$item = $this->get('item');
?>
<table class="details table table-striped table-sm">
    <tbody>
    <tr>
        <td class="name">
            <?= translator()->trans('name'); ?>:
        </td>
        <td class="value">
            <?= $item->getName(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('code'); ?>:
        </td>
        <td class="value">
            <?= $item->getUuid(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('status'); ?>:
        </td>
        <td class="value">
            <?= $item->getStatusObject()->getLabelHTML(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('created'); ?>:
        </td>
        <td class="value">
            <?= $item->created_at; ?>
        </td>
    </tr>
    </tbody>
</table>