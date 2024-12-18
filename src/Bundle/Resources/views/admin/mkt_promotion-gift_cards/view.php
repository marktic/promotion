<?php declare(strict_types=1);

use Marktic\Promotion\GiftCards\DataObjects\GiftCardParty;
use Nip\View\View;

/** @var View $this */
?>
<div class="d-grid gap-3">
    <?= $this->Flash()->render($this->get('controller')); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $this->load('/mkt_promotion-gift_cards/modules/panels/item-details'); ?>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-3">
                <?= $this->load('/mkt_promotion-gift_cards/modules/panels/item-party', ['type' => GiftCardParty::TYPE_SENDER]); ?>
                <?= $this->load('/mkt_promotion-gift_cards/modules/panels/item-party', ['type' => GiftCardParty::TYPE_RECIPIENT]); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-3">
                <?= $this->load('/mkt_promotion-gift_cards/modules/panels/item-promotion'); ?>
            </div>
        </div>
    </div>
</div>
