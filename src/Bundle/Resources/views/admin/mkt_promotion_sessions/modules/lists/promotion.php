<?php declare(strict_types=1);

use ByTIC\Models\SmartProperties\Properties\Statuses\Generic;
use Marktic\Promotion\Bundle\Models\PromotionSessions\PromotionSession;
use Nip\Records\Record;
use Nip\View\View;

/**
 * @var View $this
 * @var PromotionSession[]|null $items
 */
$items ??= $this->get('promotion_sessions');
$type ??= 'view';
?>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>
            SUBJECT
        </th>
        <th>
            PARAMS
        </th>
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
                <?php
                $status = method_exists($subject, 'getStatus') ? $subject->getStatus() : null;
                $statusHtml = $status instanceof Generic ? $status->getLabelHTML(true) : '';
                ?>
                <?= $statusHtml; ?>
            </td>
            <td>
                <?php if ($subject instanceof Record) { ?>

                    <a href="<?= $subject->getURL(); ?>">
                        <?= $subject->getName(); ?>
                    </a>
                <?php } else { ?>
                    ---
                <?php } ?>
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
