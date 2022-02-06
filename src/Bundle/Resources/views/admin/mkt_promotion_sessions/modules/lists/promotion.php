<?php

use Marktic\Promotion\Bundle\Models\PromotionSessions\PromotionSession;
use Nip\View\View;

/** @var $this View */

/** @var PromotionSession[] $items */
$items = $items ?? $this->get('promotion_sessions');
$type = $type ?? 'view';
?>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th></th>
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
                <?= json_encode($item->getConfiguration()->toArray()); ?> /
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
