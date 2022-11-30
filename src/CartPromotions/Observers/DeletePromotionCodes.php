<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Observers;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;

class DeletePromotionCodes
{
    /**
     * @var CartPromotion
     */
    protected $cartPromotion;

    public function __construct($cartPromotion)
    {
        $this->cartPromotion = $cartPromotion;
    }

    public static function for($cartPromotion)
    {
        $observer = new self($cartPromotion);
        $observer->execute();
    }

    protected function execute()
    {
        $codes = $this->cartPromotion->getPromotionCodes();
        $codes->delete();

        $actions = $this->cartPromotion->getPromotionActions();
        $actions->delete();

        $sessions = $this->cartPromotion->getPromotionSessions();
        $sessions->delete();

        $rules = $this->cartPromotion->getPromotionRules();
        $rules->delete();
    }
}
