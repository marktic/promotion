<?php

use Marktic\Promotion\Utility\PromotionModels; ?>
<thead>
<tr>
    <th><?= translator()->trans('name'); ?></th>
    <th><?= translator()->trans('code'); ?></th>
    <th><?= translator()->trans('uses'); ?></th>
    <th><?= PromotionModels::promotionActions()->getLabel('title'); ?></th>
    <th><?= translator()->trans('date'); ?></th>
</tr>
</thead>