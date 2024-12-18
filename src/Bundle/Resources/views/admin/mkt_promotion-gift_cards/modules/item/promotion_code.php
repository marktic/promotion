<?php

use Marktic\Promotion\Utility\PromotionModels;

$promotion_code = $this->get('promotion_code');
?>
<?php if (!$promotion_code) { ?>
    <?= $this->Messages()->info(PromotionModels::giftProducts()->getMessage('promotion_code.dnx')) ?>
    <?php return; ?>
<?php } ?>

+++++ END +++++