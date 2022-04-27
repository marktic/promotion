<?php

namespace Marktic\Promotion\CartPromotions\Observers;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\Utility\PromotionModels;

class DeletePromotionCodes
{
    /**
     * @var CartPromotion
     */
    protected $cartPromotion;

    /**
     * @param $cartPromotion
     */
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