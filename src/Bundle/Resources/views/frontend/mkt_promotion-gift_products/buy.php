<?php

/** @var \Marktic\Promotion\GiftProducts\Models\GiftProduct $giftProduct */
$giftProduct = $this->giftProduct;

/** @var \Marktic\Promotion\Bundle\Forms\Frontend\GiftCards\BuyForm $form */
$form = $this->form;
$priceCalculator = $this->priceCalculator;
?>

<h3>
    <?= $giftProduct->getName() ?>
</h3>

<?= $form->render() ?>
