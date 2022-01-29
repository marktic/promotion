<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$actionsRepository = PromotionModels::promotionActions();
?>

<?=
Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle($actionsRepository->getLabel('title'))
    ->addHtmlClass('bg-light', 'body')
    ->withViewContent('/mkt_promotion_actions/modules/lists/promotion', ['type' => 'edit']);
?>