<?php declare(strict_types=1);

use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
?>
<thead>
<tr>
    <th>ID</th>
    <th><?= PromotionModels::giftProducts()->getLabel('title.singular'); ?></th>
    <th><?= PromotionModels::giftProducts()->getLabel('sender'); ?></th>
    <th><?= PromotionModels::giftProducts()->getLabel('recipient'); ?></th>
    <th><?= translator()->trans('status'); ?></th>
    <th><?= translator()->trans('date'); ?></th>
</tr>
</thead>