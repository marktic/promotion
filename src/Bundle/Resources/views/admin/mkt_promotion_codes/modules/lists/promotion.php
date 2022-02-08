<?php

use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$items = $items ?? $this->get('promotion_codes');
$type = $type ?? 'view';
?>
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
                <a href="<?= $actionUrl ?>" data-href="<?= $actionUrl ?>"
                   data-bs-toggle="modalForm" data-bs-target="#modalForm"
                   class="btn btn-outline-primary btn-xs float-end">
                    <?= Icons::edit(); ?>
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
