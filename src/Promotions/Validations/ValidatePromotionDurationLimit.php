<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Validations;

use DateTime;
use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\I18n\TranslatableMessage;

class ValidatePromotionDurationLimit implements ValidatesPromotion
{
    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        $now = new DateTime();
        $from = $promotion->getValidFrom();
        if ($from && $now < $from) {
            return $this->invalidResponse();
        }

        $to = $promotion->getValidTo();
        if ($to && $to < $now) {
            return $this->invalidResponse();
        }
        return ValidationResult::valid();
    }

    protected function invalidResponse(): ValidationResult
    {
        return ValidationResult::invalid(
            TranslatableMessage::create('mkt_promotion_codes.messages.form.register.bad-date')
        );
    }
}