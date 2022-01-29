<?php

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;

?>

<?=
Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle(translator()->trans('details'))
    ->addHeaderTool(
        ButtonAction::make()
            ->setUrl($this->item->getEditURL())
            ->addHtmlClass('btn-xs')
            ->setLabel(translator()->trans('edit'))
    )
    ->wrapBody(false)
    ->withViewContent('/mkt_promotions/modules/item/details');
?>