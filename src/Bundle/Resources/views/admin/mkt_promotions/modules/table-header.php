<?php

use Marktic\Promotion\Utility\PromotionModels; ?>
<thead>
<tr>
    <th><?= translator()->trans('name'); ?></th>
    <th><?= translator()->trans('code'); ?></th>
    <th><?= translator()->trans('uses'); ?></th>
    <th><?= PromotionModels::promotionActions()->getLabel('label.singular'); ?></th>
    <th><?= translator()->trans('value'); ?></th>
    <th><?= translator()->trans('date'); ?></th>
</tr>
</thead>