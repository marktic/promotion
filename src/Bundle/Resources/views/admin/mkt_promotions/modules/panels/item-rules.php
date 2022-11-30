<?php declare(strict_types=1);

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$rulesRepository = PromotionModels::promotionRules();
?>
<?= Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle($rulesRepository->getLabel('title'))
    ->addHtmlClass('bg-light', 'body')
    ->withViewContent('/mkt_promotion_rules/modules/lists/promotion', ['type' => 'edit']);
?>