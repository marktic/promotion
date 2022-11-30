<?php declare(strict_types=1);

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$codesRepository = PromotionModels::promotionCodes();
?>
<?= Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
    ->withTitle($codesRepository->getLabel('title'))
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion_codes/modules/lists/promotion', ['type' => 'edit']);
?>