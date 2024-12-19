<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Actions\Promotion;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\CartPromotions\Models\Types\CouponCode;
use Marktic\Promotion\GiftProducts\Models\GiftProduct;
use Marktic\Promotion\Utility\PromotionFactories;
use Marktic\Promotion\Utility\PromotionModels;

/**
 * @method GiftProduct getSubject()
 */
class CreatePromotionForGiftProduct extends Action
{
    public const CODE_PREFIX = 'gift-';
    public const PROMOTION_OPTION_GIFT_ID = 'gift_product_id';

    use HasSubject;


    public function handle()
    {
        $promotion = $this->findPromotion();
        if ($promotion) {
            return $promotion;
        }
        $promotion = $this->createNewPromotion();
        return $promotion;
    }

    protected function findPromotion()
    {
        $promotionRepository = PromotionModels::promotions();
        $promotion = $promotionRepository->findOneByParams(
            [
                'where' => [
                    ['pool = ?', $this->getSubject()->getPool()],
                    ['pool_id = ?', $this->getSubject()->getPoolId()],
                    ['code = ?', $this->generateCodeForProduct()],
                ]
            ]
        );
        return $promotion;
    }

    protected function createNewPromotion()
    {
        $promotion = $this->createNewPromotionRecord();
        $this->createNewPromotionAction($promotion);
        $this->createNewPromotionFilters($promotion);
        return $promotion;
    }

    protected function createNewPromotionRecord()
    {
        /** @var CartPromotion $promotion */
        $promotion = PromotionModels::promotions()->getNew();
        $promotion->setPool($this->getSubject()->getPool());
        $promotion->setPoolId($this->getSubject()->getPoolId());
        $promotion->setCode($this->generateCodeForProduct());
        $promotion->setType(CouponCode::NAME);
        $promotion->setUsageLimit(999);
        $promotion->setName(
            $this->getSubject()->getManager()->getLabel('title.singular')
            . ' '
            . $this->getSubject()->getName()
        );
        $promotion->setOption(static::PROMOTION_OPTION_GIFT_ID, $this->getSubject()->id);
        $promotion->save();
        return $promotion;
    }

    protected function generateCodeForProduct()
    {
        $code = 'gift-';
        $code .= md5((string)$this->getSubject()->id);
        return $code;
    }

    protected function createNewPromotionAction(CartPromotion $promotion)
    {
        $promotionAction = PromotionFactories::actions()->createPercentageDiscount(100);

        $actionsRelations = $promotion->getRelation(CartPromotions::RELATION_ACTIONS);
        $actions = $actionsRelations->getResults();
        $actions->add($promotionAction);
        $actionsRelations->save();
    }

    protected function createNewPromotionFilters(CartPromotion $promotion)
    {
    }
}

