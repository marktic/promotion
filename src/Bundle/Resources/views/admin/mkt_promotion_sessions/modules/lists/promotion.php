<?php

use Marktic\Promotion\Bundle\Models\PromotionSessions\PromotionSession;
use Nip\View\View;

/** @var View $this */

/** @var PromotionSession[] $items */
$items = $items ?? $this->get('promotion_sessions');
$type = $type ?? 'view';
?>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th>
            <?= translator()->trans('created'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item) { ?>
        <?php $subject = $item->getPromotionSubject(); ?>
        <tr>
            <td>
                <a href="<?= $subject->getURL(); ?>">
                    <?= $subject->getName(); ?>
                </a>
            </td>
            <td>
                <?= json_encode($item->getConfiguration()->toArray()); ?>
            </td>
            <td>
                <?= $item->created_at; ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
