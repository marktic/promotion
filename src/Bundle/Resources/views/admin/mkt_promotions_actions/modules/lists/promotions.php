<?php

use Marktic\Promotion\Utility\PromotionModels;

$actions = $actions ?? $this->promotion_actions;
?>
<?php foreach ($actions as $action) { ?>
    <?=
    $this->load(
        sprintf(
            "/%s/modules/types/badge-%s",
            PromotionModels::promotionActions()->getController(),
            $action->getType()
        ),
        [
            'action' => $action
        ]
    );
    ?>
<?php } ?>