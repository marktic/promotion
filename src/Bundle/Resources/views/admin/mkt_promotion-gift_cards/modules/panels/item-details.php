<?php declare(strict_types=1);

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Nip\View\View;

/** @var View $this */
?>

<?= Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle(translator()->trans('details'))
    ->addHeaderTool(
        ButtonAction::make()
            ->setUrl($this->get('item')->getEditURL())
            ->addHtmlClass('btn-xs')
            ->setLabel(translator()->trans('edit'))
    )
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion-gift_cards/modules/item/details');
?>