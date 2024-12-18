<?php declare(strict_types=1);

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Nip\View\View;

/** @var View $this */
/** @var \Marktic\Promotion\GiftCards\Models\GiftCard $item */
$item = $this->get('item');

$card = Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle(translator()->trans('details'))
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion-gift_cards/modules/item/promotion_code');

if (false == $item->hasPromotionCode()) {
    $card->addHeaderTool(
        ButtonAction::make()
            ->setUrl($item->compileURL('createCode'))
            ->addHtmlClass('btn-xs')
            ->setLabel(translator()->trans('create'))
    );
}
?>
<?= $card ?>