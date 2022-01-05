<?php

/** @var RecordHasValidity $item */

use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;
use Marktic\Promotion\Utility\PromotionModels;

$validFrom = $item->getValidFrom();
$validTo = $item->getValidTo();
?>
<div>
    <div>
        <span class="text-muted">
            <?= PromotionModels::promotions()->getLabel('valid_from') ?>:
        </span>
        <?= $validFrom ?>
    </div>
    <div>
        <span class="text-muted">
            <?= PromotionModels::promotions()->getLabel('valid_to') ?>:
        </span>
        <?= $validTo ?>
    </div>
</div>