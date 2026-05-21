<?php declare(strict_types=1);

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
/** @var \Marktic\Promotion\CartPromotions\Models\CartPromotion $item */
$item = $this->get('item');
$codes ??= $this->get('promotion_codes');

$codesRepository = PromotionModels::promotionCodes();
$modalId = 'promotionCodesGenerateModal-' . (int) $item->id;

$modalAction = ButtonAction::make()
        ->setUrl('#' . $modalId)
        ->addHtmlClass('btn-xs js-open-generate-codes-modal')
        ->setLabel(translator()->trans('generate'));
$modalAction->setHtmlAttributes(
                ['data-bs-toggle' => 'modal', 'data-bs-target' => '#' . $modalId]
        );
$card = Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
        ->withTitle(
                $codesRepository->getLabel('title')
                .' <small class="badge text-white text-bg-secondary"> '.count($codes ?? []).'</small>'
        )
    ->addHeaderTool(
        ButtonAction::make()
            ->setUrl($item->compileURL('createCode'))
            ->addHtmlClass('btn-xs')
            ->setLabel(translator()->trans('create'))
    )
    ->addHeaderTool($modalAction)
    ->wrapBody(false)
    ->withViewContent('/mkt_promotion_codes/modules/lists/promotion', ['type' => 'edit']);
?>
<?= $card; ?>
<div class="modal fade" id="<?= $modalId; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= $item->compileURL('generateCodes'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title"><?= translator()->trans('generate'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= translator()->trans('close'); ?>"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="<?= $modalId; ?>-count"><?= translator()->trans('number'); ?></label>
                        <input type="number" class="form-control" id="<?= $modalId; ?>-count" name="codes_count" value="10" min="1" max="1000">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="<?= $modalId; ?>-format"><?= translator()->trans('format'); ?></label>
                        <input type="text" class="form-control" id="<?= $modalId; ?>-format" name="codes_format" value="{code}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label" for="<?= $modalId; ?>-length"><?= translator()->trans('length'); ?></label>
                        <input type="number" class="form-control" id="<?= $modalId; ?>-length" name="codes_length" value="8" min="1" max="64">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= translator()->trans('cancel'); ?></button>
                    <button type="submit" class="btn btn-primary"><?= translator()->trans('generate'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
