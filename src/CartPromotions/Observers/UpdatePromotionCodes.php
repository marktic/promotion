<?php

namespace Marktic\Promotion\CartPromotions\Observers;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\Utility\PromotionModels;

class UpdatePromotionCodes
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
        if (empty($this->cartPromotion->getCode())) {
            return;
        }

        $codes = $this->cartPromotion->getPromotionCodes();
        $count = $codes->count();
        if ($count > 1) {
            return;
        }
        if ($count == 0) {
            $this->createFromPromotion($codes);
            return;
        }

        // Only one code
        $this->updateFromPromotion($codes->current());
    }

    protected function createFromPromotion($codes)
    {
        $code = PromotionModels::promotionCodes()->getNew();
        $code->populateFromPromotion($this->cartPromotion);
        $this->copyDataFromPromotion($code);
        $code->save();
        $codes->add($code);
    }

    /**
     * @param PromotionCode $code
     * @return void
     */
    protected function updateFromPromotion($code)
    {
        $doUpdate = false;
        if ($this->cartPromotion->getOriginal('code') == $code->getPropertyRaw('code')) {
            $doUpdate = true;
        }
        $this->copyDataFromPromotion($code);
        if ($doUpdate) {
            $code->save();
        }
    }

    protected function copyDataFromPromotion($code)
    {
        $fields = ['code', 'usage_limit', 'valid_from', 'valid_to'];
        foreach ($fields as $field) {
            $code->set($field, $this->cartPromotion->get($field));
        }
    }
}