<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Observers;

use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\CartPromotions\Models\Types\CouponCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\Utility\PromotionModels;

class UpdatePromotionCodes
{
    /**
     * @var CartPromotion
     */
    protected $cartPromotion;

    public function __construct($cartPromotion)
    {
        $this->cartPromotion = $cartPromotion;
    }

    public static function for($cartPromotion): void
    {
        $observer = new self($cartPromotion);
        $observer->execute();
    }

    /**
     * @return void
     */
    protected function execute()
    {
        if (CouponCode::NAME !== $this->cartPromotion->getType()) {
            return;
        }

        if (empty($this->cartPromotion->getCode())) {
            return;
        }

        $codes = $this->cartPromotion->getPromotionCodes();
        $count = $codes->count();
        if ($count > 1) {
            return;
        }
        if (0 == $count) {
            $this->createFromPromotion($codes);

            return;
        }

        // Only one code
        $this->updateFromPromotion($codes->current());
    }

    protected function createFromPromotion(array|\Nip\Records\Collections\Collection $codes): void
    {
        $code = PromotionModels::promotionCodes()->getNew();
        $code->populateFromPromotion($this->cartPromotion);
        $this->copyDataFromPromotion($code);
        $code->save();
        $codes->add($code);
    }

    /**
     * @param PromotionCode $code
     *
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

    protected function copyDataFromPromotion(PromotionCode $code): void
    {
        $fields = ['code', 'usage_limit', 'valid_from', 'valid_to'];
        foreach ($fields as $field) {
            $code->set($field, $this->cartPromotion->get($field));
        }
    }
}
