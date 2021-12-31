<?php

namespace Marktic\Promotion\Bundle\Models\PromotionActions;

/**
 * Class PromotionActions
 * @package Marktic\Promotion\Bundle\Models\PromotionActions
 */
class PromotionActions extends \Marktic\Promotion\PromotionActions\Models\PromotionActions
{
    public function translateType($slug, $params = []): string
    {
        return $this->translate('types.' . $slug, $params);
    }
}
