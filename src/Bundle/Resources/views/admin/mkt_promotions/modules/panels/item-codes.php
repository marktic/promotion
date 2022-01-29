<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$codesRepository = PromotionModels::promotionCodes();
?>
<?=
Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle($codesRepository->getLabel('title'))
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion_codes/modules/lists/promotion', ['type' => 'edit']);
?>