<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Promotion\CartPromotions\Models\CartPromotion;
use Marktic\Promotion\GiftCards\Exceptions\PromotionCode\PromotionCodeGenerationException;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\GiftProducts\Actions\Promotion\CreatePromotionForGiftProduct;
use Marktic\Promotion\PromotionCodes\Generator\Codes\UniqueCodeGenerator;
use Marktic\Promotion\PromotionCodes\Generator\Instruction\CodeGeneratorInstruction;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\I18n\TranslatableMessage;
use Nip\Utility\Str;

/**
 * @method GiftCard getSubject()
 */
class GeneratePromotionForGiftCard extends Action
{
    use HasSubject;


    public function handle()
    {
        $this->guardAlreadyHasPromotion();
        $this->guardStatus();

        $this->createPromotionLinks();
    }

    protected function createPromotionLinks()
    {
        $promotion = $this->createPromotionRecord();
        $code = $this->createPromotionCodeRecord($promotion);

        $this->getSubject()->setPromotionCodeId($code->id);
        $this->getSubject()->save();
    }

    protected function guardAlreadyHasPromotion()
    {
        if ($this->getSubject()->hasPromotionCode()) {
            $this->throwException(PromotionCodeGenerationException::MESSAGE_GENERATED);
        }
    }

    protected function guardStatus()
    {
        if (!$this->getSubject()->getStatusObject()->canGeneratePromotion()) {
            $this->throwException(
                PromotionCodeGenerationException::MESSAGE_STATUS_INVALID,
                ['status' => $this->getSubject()->getStatusObject()->getLabel()]
            );
        }
    }

    protected function throwException($message, $params = [])
    {
        $message = TranslatableMessage::create(
            PromotionModels::giftCards()->getTranslateRoot()
            . 'messages.promotion_code'
            . '.' . $message,
            $params
        )->__toString();
        throw new PromotionCodeGenerationException($message);
    }

    protected function createPromotionRecord()
    {
        if ($this->getSubject()->hasPromotion()) {
            return $this->getSubject()->getPromotion();
        }
        $promotion = CreatePromotionForGiftProduct::for($this->getSubject()->getGiftProduct())->handle();
        $this->getSubject()->setPromotionId($promotion->id);
        return $promotion;
    }

    /**
     * @param CartPromotion $promotion
     * @return \Marktic\Promotion\PromotionCodes\Models\PromotionCode
     */
    protected function createPromotionCodeRecord($promotion)
    {
        $codes = $promotion->getPromotionCodes();
        $UniqueCode = $this->generateCodeForCard();
        if ($codes->count() == 1) {
            $firstCode = $codes->first();
            if (Str::startsWith($firstCode->getCode(), CreatePromotionForGiftProduct::CODE_PREFIX)) {
                $firstCode->setCode($UniqueCode);
                $firstCode->save();
                return $firstCode;
            }
        }
        $code = PromotionModels::promotionCodes()->getNew();
        $code->setPromotionId($promotion->id);
        $code->setCode($UniqueCode);
        $code->save();
        return $code;
    }

    protected function generateCodeForCard(): string
    {
        $instructions = CodeGeneratorInstruction::default();
        $instructions->setCodeLength(6);
        return UniqueCodeGenerator::oneFor($instructions);
    }
}