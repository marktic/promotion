<?php

namespace Marktic\Promotion\PromotionCodes\Actions;

use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\PromotionCodes\Validations\CompositePromotionCodeValidation;
use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeDurationLimitValidation;
use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeUsageLimitValidation;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\I18n\TranslatableMessage;

class CheckValidPromotionCode
{
    /**
     * @var PromotionCodes
     */
    protected $promotionCodeRepository;

    public function __construct($promotionCodeRepository = null)
    {
        $this->promotionCodeRepository = $promotionCodeRepository ?? PromotionModels::promotionCodes();
    }

    /**
     * @throws InvalidPromotionalCode
     */
    public static function for(PromotionSubjectInterface $subject, string $promotionCode): ?PromotionCodeInterface
    {
        return (new self())->execute($subject, $promotionCode);
    }

    /**
     * @throws InvalidPromotionalCode
     */
    public function execute(PromotionSubjectInterface $subject, string $promotionCode): ?PromotionCodeInterface
    {
        $promotionCode = $this->findPromotionCode($promotionCode);
        $this->validatePromotionCode($subject, $promotionCode);

        return $promotionCode;
    }

    /**
     * @throws InvalidPromotionalCode
     */
    protected function findPromotionCode($promotionCode)
    {
        $promotionCode = $this->promotionCodeRepository->findOneByCode($promotionCode);

        if (!is_object($promotionCode)) {
            throw new InvalidPromotionalCode(
                TranslatableMessage::create('mkt_promotions.messages.form.register.dnx')
            );
        }

        return $promotionCode;
    }

    /**
     * @throws InvalidPromotionalCode
     */
    protected function validatePromotionCode(PromotionSubjectInterface $subject, PromotionCodeInterface $promotionCode)
    {
        $checker = $this->buildEligibilityChecker();
        $response = $checker->isEligible($subject, $promotionCode);

        if ($response->isInvalid()) {
            throw new InvalidPromotionalCode($response->message());
        }
    }

    protected function buildEligibilityChecker(): CompositePromotionCodeValidation
    {
        return new CompositePromotionCodeValidation([
            new PromotionCodeDurationLimitValidation(),
            new PromotionCodeUsageLimitValidation(),
        ]);
    }
}
