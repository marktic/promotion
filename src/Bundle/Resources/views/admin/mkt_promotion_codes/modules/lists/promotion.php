<?php declare(strict_types=1);

use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$items ??= $this->get('promotion_codes');
$type ??= 'view';
$promotion = $this->get('item');
?>
<?php if ($promotion) { ?>
    <div class="mb-2 d-flex flex-wrap gap-2 align-items-end">
        <a href="<?= $promotion->compileURL('createCode'); ?>" class="btn btn-sm btn-outline-primary">
            <?= translator()->trans('create'); ?>
        </a>
        <form method="post" action="<?= $promotion->compileURL('generateCodes'); ?>" class="d-flex flex-wrap gap-2 align-items-end">
            <div>
                <label class="form-label mb-0" for="codes_count"><?= translator()->trans('number'); ?></label>
                <input type="number" class="form-control form-control-sm" id="codes_count" name="codes_count" value="10" min="1" max="1000">
            </div>
            <div>
                <label class="form-label mb-0" for="codes_format"><?= translator()->trans('format'); ?></label>
                <input type="text" class="form-control form-control-sm" id="codes_format" name="codes_format" value="{code}">
            </div>
            <div>
                <label class="form-label mb-0" for="codes_length"><?= translator()->trans('length'); ?></label>
                <input type="number" class="form-control form-control-sm" id="codes_length" name="codes_length" value="8" min="1" max="64">
            </div>
            <button type="submit" class="btn btn-sm btn-outline-secondary">
                <?= translator()->trans('generate'); ?>
            </button>
        </form>
    </div>
<?php } ?>
<table class="table">
    <thead>
    <tr>
        <th><?= translator()->trans('code'); ?></th>
        <th><?= translator()->trans('uses'); ?></th>
        <th><?= PromotionModels::promotions()->getLabel('validity'); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item) { ?>
        <?php $actionUrl = $item->compileURL('edit'); ?>
        <tr>
            <td>
                <div class="bg-light fw-bold px-2 font-monospace">
                    <?= $item->code; ?>
                </div>
            </td>
            <td>
                <?= $item->getUsed(); ?> /
                <?= $item->getUsageLimit(); ?>
            </td>
            <td>
                <?= $this->load('/mkt_base/modules/validity', ['item' => $item]); ?>
            </td>
            <td>
                <a href="<?= $actionUrl; ?>" data-href="<?= $actionUrl; ?>"
                   data-bs-toggle="modalForm" data-bs-target="#modalForm"
                   class="btn btn-outline-primary btn-xs float-end">
                    <?= Icons::edit(); ?>
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
