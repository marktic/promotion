<?php declare(strict_types=1);

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardParty;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$repository = PromotionModels::giftCards();

/** @var GiftCard $item */
$item = $this->get('item');

$type = $type ?? GiftCardParty::TYPE_SENDER;
$party = $item->getConfiguration()->getParty($type);
?>
<table class="details table table-striped table-sm">
    <tbody>
    <tr>
        <td class="name">
            <?= translator()->trans('first_name'); ?>:
        </td>
        <td class="value">
            <?= $party->getFirstName(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('last_name'); ?>:
        </td>
        <td class="value">
            <?= $party->getLastName(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('email'); ?>:
        </td>
        <td class="value">
            <?= $party->getEmail(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('phone'); ?>:
        </td>
        <td class="value">
            <?= $party->getPhone(); ?>
        </td>
    </tr>
    </tbody>
</table>