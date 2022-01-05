<?php

use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$items = $items ?? $this->promotion_codes;
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
            <td><?= $item->code; ?></td>
            <td>
                <?= $item->getUsed(); ?> /
                <?= $item->getUsageLimit(); ?>
            </td>
            <td>
                <?= $item->getValidFrom(); ?> /
                <?= $item->getValidTo(); ?>
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
