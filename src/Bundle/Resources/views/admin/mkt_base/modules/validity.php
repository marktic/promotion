<?php

use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
/** @var RecordHasValidity $item */
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