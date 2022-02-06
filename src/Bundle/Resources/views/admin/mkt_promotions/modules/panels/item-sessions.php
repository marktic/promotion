<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var $this View */

$repository = PromotionModels::promotionSessions();
?>
<?=
Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle($repository->getLabel('title'))
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion_sessions/modules/lists/promotion', ['type' => 'edit']);
?>