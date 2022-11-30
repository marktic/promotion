<?php

use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
?>
<thead>
<tr>
    <th><?= translator()->trans('name'); ?></th>
    <th><?= translator()->trans('type'); ?></th>
    <th><?= translator()->trans('code'); ?></th>
    <th><?= translator()->trans('uses'); ?></th>
    <th><?= PromotionModels::promotionActions()->getLabel('title'); ?></th>
    <th><?= translator()->trans('date'); ?></th>
</tr>
</thead>