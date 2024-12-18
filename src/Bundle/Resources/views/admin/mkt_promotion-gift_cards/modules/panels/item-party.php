<?php declare(strict_types=1);

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardParty;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

$type = $type ?? GiftCardParty::TYPE_SENDER;
$repository = PromotionModels::giftCards();
/** @var View $this */
?>

<?= Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle($repository->getLabel($type))
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion-gift_cards/modules/item/party', ['type' => $type]);
?>