<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Models\PromotionRules;

/**
 * Class PromotionRules.
 */
class PromotionRules extends \Marktic\Promotion\PromotionRules\Models\PromotionRules
{
    public function translateType($slug, $params = []): string
    {
        return $this->translate('types.' . $slug, $params);
    }
}
