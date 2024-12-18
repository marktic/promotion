<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Promotion\GiftCards\Exceptions\PromotionCode\PromotionCodeGenerationException;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\I18n\TranslatableMessage;

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
}